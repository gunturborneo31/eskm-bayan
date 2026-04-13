        .card-elevated {
            box-shadow: 0 16px 36px rgba(15, 23, 42, 0.09), 0 4px 14px rgba(15, 23, 42, 0.06);
        }

        .filter-chip {
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.625rem;
            min-width: {{ $chipMinWidth ?? '152px' }};
            padding: 0.45rem 2rem 0.45rem 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 9999px;
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.04);
            overflow: visible;
        }

        .filter-chip summary {
            list-style: none;
            display: flex;
            align-items: center;
            gap: 0.45rem;
            width: 100%;
            padding: 0;
            cursor: pointer;
        }

        .filter-chip summary::-webkit-details-marker {
            display: none;
        }

        .filter-chip-value {
            font-size: 0.68rem;
            font-weight: 800;
            color: #0f172a;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .filter-chip-caret {
            margin-left: auto;
            color: #94a3b8;
            font-size: 15px;
            transition: transform 0.16s ease;
        }

        .filter-inline {
            display: flex;
            align-items: center;
            gap: 0.45rem;
            position: relative;
            overflow: visible;
        }

        .filter-inline-label {
            font-size: 8px;
            font-weight: 900;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: #94a3b8;
            white-space: nowrap;
        }

        .filter-menu {
            position: fixed;
            min-width: 10rem;
            padding: 0.4rem;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            background: #ffffff;
            box-shadow: 0 16px 40px rgba(15, 23, 42, 0.12);
            z-index: 9999;
            display: none;
        }

        .filter-menu a {
            display: flex;
            align-items: center;
            padding: 0.55rem 0.75rem;
            border-radius: 0.75rem;
            font-size: 0.72rem;
            font-weight: 700;
            color: #334155;
            text-decoration: none;
        }

        .filter-menu a:hover {
            background: #fff7ed;
            color: #ea580c;
        }

        .filter-menu a.is-active {
            background: #fff7ed;
            color: #c2410c;
        }

        .filter-chip[open] {
            border-color: #fdba74;
            box-shadow: 0 0 0 4px rgba(255, 136, 0, 0.08);
        }

        .filter-chip[open] .filter-chip-caret {
            transform: rotate(180deg);
        }

        .filter-chip[open] .filter-menu {
            display: block;
            animation: dropdown-fade 0.16s ease-out;
            transform-origin: top center;
        }

        .admin-button {
            border: 1px solid #fed7aa;
            background: linear-gradient(180deg, #fff7ed 0%, #ffedd5 100%);
            color: #c2410c;
            padding: 0.45rem 1rem;
            border-radius: 9999px;
            font-size: 0.68rem;
            font-weight: 800;
            letter-spacing: 0.01em;
            transition: all 0.18s ease;
        }

        .admin-button:hover {
            background: linear-gradient(180deg, #ffedd5 0%, #fed7aa 100%);
            border-color: #fdba74;
        }

        @keyframes dropdown-fade {
            from {
                opacity: 0;
                transform: translateY(-6px) scale(0.98);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }



