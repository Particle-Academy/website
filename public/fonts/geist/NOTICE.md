# Geist and Geist Mono

The site's typeface, self-hosted so that no page requests a font from a third-party host.

| | |
|---|---|
| Upstream | https://github.com/vercel/geist-font |
| Release | v1.9.0, published 2026-10-30 (tag commit `72f67167dd304a842ef8899da57fa25c5cf21756`) |
| Download | https://github.com/vercel/geist-font/releases/download/v1.9.0/geist-font-v1.9.0.zip |
| Archive SHA-256 | `1f2dd9ea90e68d0358a1d234a5f156807b2c3e0e295d78d87980a6dbad1fa58c` |
| Licence | SIL Open Font License 1.1, in `OFL.txt` (copied from the archive's `geist-font/OFL.txt`) |
| Copyright | 2024 The Geist Project Authors |
| Approval | Google Fonts approved as a source by the owner on 2026-10-26, on condition the files are served same-origin; Geist is published there under the same licence |

## Files

The files are byte-for-byte copies of the release's variable webfonts. Only the names changed: the upstream names contain `[` and `]`, which are awkward in URLs.

| File here | File in the archive | SHA-256 |
|---|---|---|
| `Geist-Variable.woff2` | `geist-font/Geist/webfonts/Geist[wght].woff2` | `5c5588027e59e74e205b9d6c7fd877b261091cee367f6bb3a8d505da14cae512` |
| `GeistMono-Variable.woff2` | `geist-font/GeistMono/webfonts/GeistMono[wght].woff2` | `cf5bf55f69e043b1ecf04b0719119b7298e94add67ebcaa709a925b945b46b25` |
| `OFL.txt` | `geist-font/OFL.txt` | `c683bfbcc7e087f5d37a54ef628f10387c451a83ddc459b151403a164ac46c90` |

The site used Geist at weights 300 to 700 and Geist Mono at 400 to 600, roman only, with no italics. One variable file per family covers those weights in about 70 KB, against about 230 KB for the five static Geist weights alone. Google Fonts was also serving Geist as a variable font, from an older release (1.800).

To update: download a newer release, copy the same two files over these, update this table, and run `php artisan test --compact tests/Feature/WebFontsTest.php`.
