<div class="bg-white border border-slate-100 rounded-[1vw] card-elevated p-[0.8rem] scale-[0.95] origin-top">
    <p class="text-base font-black uppercase tracking-tight mb-[0.6rem]">{{ $section['title'] }}</p>
    <div id="{{ $section['key'] }}" class="h-[224px]"></div>
</div>

<div class="bg-white border border-slate-100 rounded-[1vw] card-elevated p-[0.8rem] scale-[0.95] origin-top">
    <p class="text-base font-black uppercase tracking-tight mb-[0.6rem]">Tabel {{ $section['title'] }}</p>
    <table class="w-full text-[12px]">
        <thead>
            <tr class="bg-[#FF8800] text-white">
                <th class="py-[0.4rem] px-3 text-left">No</th>
                <th class="py-[0.4rem] px-3 text-left">{{ $section['title'] }}</th>
                <th class="py-[0.4rem] px-3 text-right">Jumlah</th>
                <th class="py-[0.4rem] px-3 text-center">Warna</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @foreach ($section['data'] as $index => $row)
                <tr class="hover:bg-slate-50">
                    <td class="py-[0.4rem] px-3">{{ $index + 1 }}</td>
                    <td class="py-[0.4rem] px-3">{{ $row['label'] }}</td>
                    <td class="py-[0.4rem] px-3 text-right font-black">{{ $row['total'] }}</td>
                    <td class="py-[0.4rem] px-3">
                        <div class="mx-auto h-4 w-4 rounded-full border border-slate-300" style="background-color: {{ $section['colors'][$index] ?? '#94A3B8' }};"></div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>



