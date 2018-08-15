/**
 * Created by Hajay on 2018/1/2.
 */

module.exports = {
    url: '/candy',
    views: {
        'user': {
            template: __inline('index.html?v=1'),
            controller: ['$scope', '$http', '$cookies', '$state', '$', 'userInfo', function($scope, $http, $cookies, $state, $, userInfo){
                $scope.g.currPage = 'user';
                $scope.userInfo.menu = "candy";
                $scope.userInfo.openSubMenu.securitySettings = false;
                $scope.info = {
                    countryList:[
                        {
                            n: "Afghanistan (‫افغانستان‬‎)",
                            i: "af",
                            d: "93"
                        }, {
                            n: "Åland Islands (Åland)",
                            i: "ax",
                            d: "358"
                        }, {
                            n: "Albania (Shqipëri)",
                            i: "al",
                            d: "355"
                        }, {
                            n: "Algeria (‫الجزائر‬‎)",
                            i: "dz",
                            d: "213"
                        }, {
                            n: "American Samoa",
                            i: "as",
                            d: "1684"
                        }, {
                            n: "Andorra",
                            i: "ad",
                            d: "376"
                        }, {
                            n: "Angola",
                            i: "ao",
                            d: "244"
                        }, {
                            n: "Anguilla",
                            i: "ai",
                            d: "1264"
                        }, {
                            n: "Antigua and Barbuda",
                            i: "ag",
                            d: "1268"
                        }, {
                            n: "Argentina",
                            i: "ar",
                            d: "54"
                        }, {
                            n: "Armenia (Հայաստան)",
                            i: "am",
                            d: "374"
                        }, {
                            n: "Aruba",
                            i: "aw",
                            d: "297"
                        }, {
                            n: "Australia",
                            i: "au",
                            d: "61"
                        }, {
                            n: "Austria (Österreich)",
                            i: "at",
                            d: "43"
                        }, {
                            n: "Azerbaijan (Azərbaycan)",
                            i: "az",
                            d: "994"
                        }, {
                            n: "Bahamas",
                            i: "bs",
                            d: "1242"
                        }, {
                            n: "Bahrain (‫البحرين‬‎)",
                            i: "bh",
                            d: "973"
                        }, {
                            n: "Bangladesh (বাংলাদেশ)",
                            i: "bd",
                            d: "880"
                        }, {
                            n: "Barbados",
                            i: "bb",
                            d: "1246"
                        }, {
                            n: "Belarus (Беларусь)",
                            i: "by",
                            d: "375"
                        }, {
                            n: "Belgium (België)",
                            i: "be",
                            d: "32"
                        }, {
                            n: "Belize",
                            i: "bz",
                            d: "501"
                        }, {
                            n: "Benin (Bénin)",
                            i: "bj",
                            d: "229"
                        }, {
                            n: "Bermuda",
                            i: "bm",
                            d: "1441"
                        }, {
                            n: "Bhutan (འབྲུག)",
                            i: "bt",
                            d: "975"
                        }, {
                            n: "Bolivia",
                            i: "bo",
                            d: "591"
                        }, {
                            n: "Bosnia and Herzegovina (Босна и Херцеговина)",
                            i: "ba",
                            d: "387"
                        }, {
                            n: "Botswana",
                            i: "bw",
                            d: "267"
                        }, {
                            n: "Brazil (Brasil)",
                            i: "br",
                            d: "55"
                        }, {
                            n: "British Indian Ocean Territory",
                            i: "io",
                            d: "246"
                        }, {
                            n: "British Virgin Islands",
                            i: "vg",
                            d: "1284"
                        }, {
                            n: "Brunei",
                            i: "bn",
                            d: "673"
                        }, {
                            n: "Bulgaria (България)",
                            i: "bg",
                            d: "359"
                        }, {
                            n: "Burkina Faso",
                            i: "bf",
                            d: "226"
                        }, {
                            n: "Burundi (Uburundi)",
                            i: "bi",
                            d: "257"
                        }, {
                            n: "Cambodia (កម្ពុជា)",
                            i: "kh",
                            d: "855"
                        }, {
                            n: "Cameroon (Cameroun)",
                            i: "cm",
                            d: "237"
                        }, {
                            n: "Canada",
                            i: "ca",
                            d: "1"
                        }, {
                            n: "Cape Verde (Kabu Verdi)",
                            i: "cv",
                            d: "238"
                        }, {
                            n: "Caribbean Netherlands",
                            i: "bq",
                            d: "5997"
                        }, {
                            n: "Cayman Islands",
                            i: "ky",
                            d: "1345"
                        }, {
                            n: "Central African Republic (République centrafricaine)",
                            i: "cf",
                            d: "236"
                        }, {
                            n: "Chad (Tchad)",
                            i: "td",
                            d: "235"
                        }, {
                            n: "Chile",
                            i: "cl",
                            d: "56"
                        }, {
                            n: "China (中国)",
                            i: "cn",
                            d: "86"
                        }, {
                            n: "Christmas Island",
                            i: "cx",
                            d: "61"
                        }, {
                            n: "Cocos (Keeling) Islands (Kepulauan Cocos (Keeling))",
                            i: "cc",
                            d: "61"
                        }, {
                            n: "Colombia",
                            i: "co",
                            d: "57"
                        }, {
                            n: "Comoros (‫جزر القمر‬‎)",
                            i: "km",
                            d: "269"
                        }, {
                            n: "Congo (DRC) (Jamhuri ya Kidemokrasia ya Kongo)",
                            i: "cd",
                            d: "243"
                        }, {
                            n: "Congo (Republic) (Congo-Brazzaville)",
                            i: "cg",
                            d: "242"
                        }, {
                            n: "Cook Islands",
                            i: "ck",
                            d: "682"
                        }, {
                            n: "Costa Rica",
                            i: "cr",
                            d: "506"
                        }, {
                            n: "Côte d’Ivoire",
                            i: "ci",
                            d: "225"
                        }, {
                            n: "Croatia (Hrvatska)",
                            i: "hr",
                            d: "385"
                        }, {
                            n: "Cuba",
                            i: "cu",
                            d: "53"
                        }, {
                            n: "Curaçao",
                            i: "cw",
                            d: "5999"
                        }, {
                            n: "Cyprus (Κύπρος)",
                            i: "cy",
                            d: "357"
                        }, {
                            n: "Czech Republic (Česká republika)",
                            i: "cz",
                            d: "420"
                        }, {
                            n: "Denmark (Danmark)",
                            i: "dk",
                            d: "45"
                        }, {
                            n: "Djibouti",
                            i: "dj",
                            d: "253"
                        }, {
                            n: "Dominica",
                            i: "dm",
                            d: "1767"
                        }, {
                            n: "Dominican Republic (República Dominicana)",
                            i: "do",
                            d: "1809"
                        }, {
                            n: "Dominican Republic (República Dominicana)",
                            i: "do",
                            d: "1829"
                        }, {
                            n: "Dominican Republic (República Dominicana)",
                            i: "do",
                            d: "1849"
                        }, {
                            n: "Ecuador",
                            i: "ec",
                            d: "593"
                        }, {
                            n: "Egypt (‫مصر‬‎)",
                            i: "eg",
                            d: "20"
                        }, {
                            n: "El Salvador",
                            i: "sv",
                            d: "503"
                        }, {
                            n: "Equatorial Guinea (Guinea Ecuatorial)",
                            i: "gq",
                            d: "240"
                        }, {
                            n: "Eritrea",
                            i: "er",
                            d: "291"
                        }, {
                            n: "Estonia (Eesti)",
                            i: "ee",
                            d: "372"
                        }, {
                            n: "Ethiopia",
                            i: "et",
                            d: "251"
                        }, {
                            n: "Falkland Islands (Islas Malvinas)",
                            i: "fk",
                            d: "500"
                        }, {
                            n: "Faroe Islands (Føroyar)",
                            i: "fo",
                            d: "298"
                        }, {
                            n: "Fiji",
                            i: "fj",
                            d: "679"
                        }, {
                            n: "Finland (Suomi)",
                            i: "fi",
                            d: "358"
                        }, {
                            n: "France",
                            i: "fr",
                            d: "33"
                        }, {
                            n: "French Guiana (Guyane française)",
                            i: "gf",
                            d: "594"
                        }, {
                            n: "French Polynesia (Polynésie française)",
                            i: "pf",
                            d: "689"
                        }, {
                            n: "Gabon",
                            i: "ga",
                            d: "241"
                        }, {
                            n: "Gambia",
                            i: "gm",
                            d: "220"
                        }, {
                            n: "Georgia (საქართველო)",
                            i: "ge",
                            d: "995"
                        }, {
                            n: "Germany (Deutschland)",
                            i: "de",
                            d: "49"
                        }, {
                            n: "Ghana (Gaana)",
                            i: "gh",
                            d: "233"
                        }, {
                            n: "Gibraltar",
                            i: "gi",
                            d: "350"
                        }, {
                            n: "Greece (Ελλάδα)",
                            i: "gr",
                            d: "30"
                        }, {
                            n: "Greenland (Kalaallit Nunaat)",
                            i: "gl",
                            d: "299"
                        }, {
                            n: "Grenada",
                            i: "gd",
                            d: "1473"
                        }, {
                            n: "Guadeloupe",
                            i: "gp",
                            d: "590"
                        }, {
                            n: "Guam",
                            i: "gu",
                            d: "1671"
                        }, {
                            n: "Guatemala",
                            i: "gt",
                            d: "502"
                        }, {
                            n: "Guernsey",
                            i: "gg",
                            d: "44"
                        }, {
                            n: "Guinea (Guinée)",
                            i: "gn",
                            d: "224"
                        }, {
                            n: "Guinea-Bissau (Guiné Bissau)",
                            i: "gw",
                            d: "245"
                        }, {
                            n: "Guyana",
                            i: "gy",
                            d: "592"
                        }, {
                            n: "Haiti",
                            i: "ht",
                            d: "509"
                        }, {
                            n: "Honduras",
                            i: "hn",
                            d: "504"
                        }, {
                            n: "Hong Kong (香港)",
                            i: "hk",
                            d: "852"
                        }, {
                            n: "Hungary (Magyarország)",
                            i: "hu",
                            d: "36"
                        }, {
                            n: "Iceland (Ísland)",
                            i: "is",
                            d: "354"
                        }, {
                            n: "India (भारत)",
                            i: "in",
                            d: "91"
                        }, {
                            n: "Indonesia",
                            i: "id",
                            d: "62"
                        }, {
                            n: "Iran (‫ایران‬‎)",
                            i: "ir",
                            d: "98"
                        }, {
                            n: "Iraq (‫العراق‬‎)",
                            i: "iq",
                            d: "964"
                        }, {
                            n: "Ireland",
                            i: "ie",
                            d: "353"
                        }, {
                            n: "Isle of Man",
                            i: "im",
                            d: "44"
                        }, {
                            n: "Israel (‫ישראל‬‎)",
                            i: "il",
                            d: "972"
                        }, {
                            n: "Italy (Italia)",
                            i: "it",
                            d: "39"
                        }, {
                            n: "Jamaica",
                            i: "jm",
                            d: "1876"
                        }, {
                            n: "Japan (日本)",
                            i: "jp",
                            d: "81"
                        }, {
                            n: "Jersey",
                            i: "je",
                            d: "44"
                        }, {
                            n: "Jordan (‫الأردن‬‎)",
                            i: "jo",
                            d: "962"
                        }, {
                            n: "Kazakhstan (Казахстан)",
                            i: "kz",
                            d: "7"
                        }, {
                            n: "Kenya",
                            i: "ke",
                            d: "254"
                        }, {
                            n: "Kiribati",
                            i: "ki",
                            d: "686"
                        }, {
                            n: "Kosovo (Kosovë)",
                            i: "xk",
                            d: "377"
                        }, {
                            n: "Kosovo (Kosovë)",
                            i: "xk",
                            d: "383"
                        }, {
                            n: "Kuwait (‫الكويت‬‎)",
                            i: "kw",
                            d: "965"
                        }, {
                            n: "Kyrgyzstan (Кыргызстан)",
                            i: "kg",
                            d: "996"
                        }, {
                            n: "Laos (ລາວ)",
                            i: "la",
                            d: "856"
                        }, {
                            n: "Latvia (Latvija)",
                            i: "lv",
                            d: "371"
                        }, {
                            n: "Lebanon (‫لبنان‬‎)",
                            i: "lb",
                            d: "961"
                        }, {
                            n: "Lesotho",
                            i: "ls",
                            d: "266"
                        }, {
                            n: "Liberia",
                            i: "lr",
                            d: "231"
                        }, {
                            n: "Libya (‫ليبيا‬‎)",
                            i: "ly",
                            d: "218"
                        }, {
                            n: "Liechtenstein",
                            i: "li",
                            d: "423"
                        }, {
                            n: "Lithuania (Lietuva)",
                            i: "lt",
                            d: "370"
                        }, {
                            n: "Luxembourg",
                            i: "lu",
                            d: "352"
                        }, {
                            n: "Macau (澳門)",
                            i: "mo",
                            d: "853"
                        }, {
                            n: "Macedonia (FYROM) (Македонија)",
                            i: "mk",
                            d: "389"
                        }, {
                            n: "Madagascar (Madagasikara)",
                            i: "mg",
                            d: "261"
                        }, {
                            n: "Malawi",
                            i: "mw",
                            d: "265"
                        }, {
                            n: "Malaysia",
                            i: "my",
                            d: "60"
                        }, {
                            n: "Maldives",
                            i: "mv",
                            d: "960"
                        }, {
                            n: "Mali",
                            i: "ml",
                            d: "223"
                        }, {
                            n: "Malta",
                            i: "mt",
                            d: "356"
                        }, {
                            n: "Marshall Islands",
                            i: "mh",
                            d: "692"
                        }, {
                            n: "Martinique",
                            i: "mq",
                            d: "596"
                        }, {
                            n: "Mauritania (‫موريتانيا‬‎)",
                            i: "mr",
                            d: "222"
                        }, {
                            n: "Mauritius (Moris)",
                            i: "mu",
                            d: "230"
                        }, {
                            n: "Mayotte",
                            i: "yt",
                            d: "262"
                        }, {
                            n: "Mexico (México)",
                            i: "mx",
                            d: "52"
                        }, {
                            n: "Micronesia",
                            i: "fm",
                            d: "691"
                        }, {
                            n: "Moldova (Republica Moldova)",
                            i: "md",
                            d: "373"
                        }, {
                            n: "Monaco",
                            i: "mc",
                            d: "377"
                        }, {
                            n: "Mongolia (Монгол)",
                            i: "mn",
                            d: "976"
                        }, {
                            n: "Montenegro (Crna Gora)",
                            i: "me",
                            d: "382"
                        }, {
                            n: "Montserrat",
                            i: "ms",
                            d: "1664"
                        }, {
                            n: "Morocco (‫المغرب‬‎)",
                            i: "ma",
                            d: "212"
                        }, {
                            n: "Mozambique (Moçambique)",
                            i: "mz",
                            d: "258"
                        }, {
                            n: "Myanmar (Burma) (မြန်မာ)",
                            i: "mm",
                            d: "95"
                        }, {
                            n: "Namibia (Namibië)",
                            i: "na",
                            d: "264"
                        }, {
                            n: "Nauru",
                            i: "nr",
                            d: "674"
                        }, {
                            n: "Nepal (नेपाल)",
                            i: "np",
                            d: "977"
                        }, {
                            n: "Netherlands (Nederland)",
                            i: "nl",
                            d: "31"
                        }, {
                            n: "New Caledonia (Nouvelle-Calédonie)",
                            i: "nc",
                            d: "687"
                        }, {
                            n: "New Zealand",
                            i: "nz",
                            d: "64"
                        }, {
                            n: "Nicaragua",
                            i: "ni",
                            d: "505"
                        }, {
                            n: "Niger (Nijar)",
                            i: "ne",
                            d: "227"
                        }, {
                            n: "Nigeria",
                            i: "ng",
                            d: "234"
                        }, {
                            n: "Niue",
                            i: "nu",
                            d: "683"
                        }, {
                            n: "Norfolk Island",
                            i: "nf",
                            d: "672"
                        }, {
                            n: "North Korea (조선 민주주의 인민 공화국)",
                            i: "kp",
                            d: "850"
                        }, {
                            n: "Northern Mariana Islands",
                            i: "mp",
                            d: "1670"
                        }, {
                            n: "Norway (Norge)",
                            i: "no",
                            d: "47"
                        }, {
                            n: "Oman (‫عُمان‬‎)",
                            i: "om",
                            d: "968"
                        }, {
                            n: "Pakistan (‫پاکستان‬‎)",
                            i: "pk",
                            d: "92"
                        }, {
                            n: "Palau",
                            i: "pw",
                            d: "680"
                        }, {
                            n: "Palestine (‫فلسطين‬‎)",
                            i: "ps",
                            d: "970"
                        }, {
                            n: "Panama (Panamá)",
                            i: "pa",
                            d: "507"
                        }, {
                            n: "Papua New Guinea",
                            i: "pg",
                            d: "675"
                        }, {
                            n: "Paraguay",
                            i: "py",
                            d: "595"
                        }, {
                            n: "Peru (Perú)",
                            i: "pe",
                            d: "51"
                        }, {
                            n: "Philippines",
                            i: "ph",
                            d: "63"
                        }, {
                            n: "Pitcairn Islands",
                            i: "pn",
                            d: "64"
                        }, {
                            n: "Poland (Polska)",
                            i: "pl",
                            d: "48"
                        }, {
                            n: "Portugal",
                            i: "pt",
                            d: "351"
                        }, {
                            n: "Puerto Rico",
                            i: "pr",
                            d: "1787"
                        }, {
                            n: "Puerto Rico",
                            i: "pr",
                            d: "1939"
                        }, {
                            n: "Qatar (‫قطر‬‎)",
                            i: "qa",
                            d: "974"
                        }, {
                            n: "Réunion (La Réunion)",
                            i: "re",
                            d: "262"
                        }, {
                            n: "Romania (România)",
                            i: "ro",
                            d: "40"
                        }, {
                            n: "Russia (Россия)",
                            i: "ru",
                            d: "7"
                        }, {
                            n: "Rwanda",
                            i: "rw",
                            d: "250"
                        }, {
                            n: "Saint Barthélemy (Saint-Barthélemy)",
                            i: "bl",
                            d: "590"
                        }, {
                            n: "Saint Helena",
                            i: "sh",
                            d: "290"
                        }, {
                            n: "Saint Kitts and Nevis",
                            i: "kn",
                            d: "1869"
                        }, {
                            n: "Saint Lucia",
                            i: "lc",
                            d: "1758"
                        }, {
                            n: "Saint Martin (Saint-Martin (partie française))",
                            i: "mf",
                            d: "590"
                        }, {
                            n: "Saint Pierre and Miquelon (Saint-Pierre-et-Miquelon)",
                            i: "pm",
                            d: "508"
                        }, {
                            n: "Saint Vincent and the Grenadines",
                            i: "vc",
                            d: "1784"
                        }, {
                            n: "Samoa",
                            i: "ws",
                            d: "685"
                        }, {
                            n: "San Marino",
                            i: "sm",
                            d: "39"
                        }, {
                            n: "San Marino",
                            i: "sm",
                            d: "378"
                        }, {
                            n: "São Tomé and Príncipe (São Tomé e Príncipe)",
                            i: "st",
                            d: "239"
                        }, {
                            n: "Saudi Arabia (‫المملكة العربية السعودية‬‎)",
                            i: "sa",
                            d: "966"
                        }, {
                            n: "Senegal (Sénégal)",
                            i: "sn",
                            d: "221"
                        }, {
                            n: "Serbia (Србија)",
                            i: "rs",
                            d: "381"
                        }, {
                            n: "Seychelles",
                            i: "sc",
                            d: "248"
                        }, {
                            n: "Sierra Leone",
                            i: "sl",
                            d: "232"
                        }, {
                            n: "Singapore",
                            i: "sg",
                            d: "65"
                        }, {
                            n: "Sint Maarten",
                            i: "sx",
                            d: "1721"
                        }, {
                            n: "Slovakia (Slovensko)",
                            i: "sk",
                            d: "421"
                        }, {
                            n: "Slovenia (Slovenija)",
                            i: "si",
                            d: "386"
                        }, {
                            n: "Solomon Islands",
                            i: "sb",
                            d: "677"
                        }, {
                            n: "Somalia (Soomaaliya)",
                            i: "so",
                            d: "252"
                        }, {
                            n: "South Africa",
                            i: "za",
                            d: "27"
                        }, {
                            n: "South Georgia & South Sandwich Islands",
                            i: "gs",
                            d: "500"
                        }, {
                            n: "South Korea (대한민국)",
                            i: "kr",
                            d: "82"
                        }, {
                            n: "South Sudan (‫جنوب السودان‬‎)",
                            i: "ss",
                            d: "211"
                        }, {
                            n: "Spain (España)",
                            i: "es",
                            d: "34"
                        }, {
                            n: "Sri Lanka (ශ්‍රී ලංකාව)",
                            i: "lk",
                            d: "94"
                        }, {
                            n: "Sudan (‫السودان‬‎)",
                            i: "sd",
                            d: "249"
                        }, {
                            n: "Suriname",
                            i: "sr",
                            d: "597"
                        }, {
                            n: "Svalbard and Jan Mayen (Svalbard og Jan Mayen)",
                            i: "sj",
                            d: "4779"
                        }, {
                            n: "Swaziland",
                            i: "sz",
                            d: "268"
                        }, {
                            n: "Sweden (Sverige)",
                            i: "se",
                            d: "46"
                        }, {
                            n: "Switzerland (Schweiz)",
                            i: "ch",
                            d: "41"
                        }, {
                            n: "Syria (‫سوريا‬‎)",
                            i: "sy",
                            d: "963"
                        }, {
                            n: "Taiwan (台灣)",
                            i: "tw",
                            d: "886"
                        }, {
                            n: "Tajikistan",
                            i: "tj",
                            d: "992"
                        }, {
                            n: "Tanzania",
                            i: "tz",
                            d: "255"
                        }, {
                            n: "Thailand (ไทย)",
                            i: "th",
                            d: "66"
                        }, {
                            n: "Timor-Leste",
                            i: "tl",
                            d: "670"
                        }, {
                            n: "Togo",
                            i: "tg",
                            d: "228"
                        }, {
                            n: "Tokelau",
                            i: "tk",
                            d: "690"
                        }, {
                            n: "Tonga",
                            i: "to",
                            d: "676"
                        }, {
                            n: "Trinidad and Tobago",
                            i: "tt",
                            d: "1868"
                        }, {
                            n: "Tunisia (‫تونس‬‎)",
                            i: "tn",
                            d: "216"
                        }, {
                            n: "Turkey (Türkiye)",
                            i: "tr",
                            d: "90"
                        }, {
                            n: "Turkmenistan",
                            i: "tm",
                            d: "993"
                        }, {
                            n: "Turks and Caicos Islands",
                            i: "tc",
                            d: "1649"
                        }, {
                            n: "Tuvalu",
                            i: "tv",
                            d: "688"
                        }, {
                            n: "Uganda",
                            i: "ug",
                            d: "256"
                        }, {
                            n: "Ukraine (Україна)",
                            i: "ua",
                            d: "380"
                        }, {
                            n: "United Arab Emirates (‫الإمارات العربية المتحدة‬‎)",
                            i: "ae",
                            d: "971"
                        }, {
                            n: "United Kingdom",
                            i: "gb",
                            d: "44"
                        }, {
                            n: "United States",
                            i: "us",
                            d: "1"
                        }, {
                            n: "U.S. Virgin Islands",
                            i: "vi",
                            d: "1340"
                        }, {
                            n: "Uruguay",
                            i: "uy",
                            d: "598"
                        }, {
                            n: "Uzbekistan (Oʻzbekiston)",
                            i: "uz",
                            d: "998"
                        }, {
                            n: "Vanuatu",
                            i: "vu",
                            d: "678"
                        }, {
                            n: "Vatican City (Città del Vaticano)",
                            i: "va",
                            d: "379"
                        }, {
                            n: "Venezuela",
                            i: "ve",
                            d: "58"
                        }, {
                            n: "Vietnam (Việt Nam)",
                            i: "vn",
                            d: "84"
                        }, {
                            n: "Wallis and Futuna",
                            i: "wf",
                            d: "681"
                        }, {
                            n: "Western Sahara (‫الصحراء الغربية‬‎)",
                            i: "eh",
                            d: "212"
                        }, {
                            n: "Yemen (‫اليمن‬‎)",
                            i: "ye",
                            d: "967"
                        }, {
                            n: "Zambia",
                            i: "zm",
                            d: "260"
                        }, {
                            n: "Zimbabwe",
                            i: "zw",
                            d: "263"
                        }
                    ],
                    currentLevel:1, //当前等级
                    beingLevel:null, //认证中的等级
                    goAuth: function(level){
                        $scope.info.authLevel = level;
                    },
                    step: 1,
                    goNext: function(){
                        $scope.info.step = 2;
                    },
                    goPrev: function(){
                        $scope.info.step = 1;
                    },
                    submitAuth: function(){
                        if($scope.info.authLevel==1){
                            $scope.info.step = 3;
                        }
                        else {
                            $scope.info.step = 2;
                        }
                    },
                    getCode: function(){
                        if($scope.g.countBeing){
                            return false;
                        }
                        var mobile = $scope.info.mobile;
                        //var regPhone = /^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/;
                        var regPhone = /^\d{6,15}$/;
                        if(!mobile || !regPhone.test(mobile)){
                            $scope.g.tip("message","Incorrect mobile format");
                            return false;
                        }
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            data: {
                                national_code: $scope.info.country.d,
                                mobile: $scope.info.mobile
                            },
                            url: 'app/common/data/get.code.php',
                            success: function(res){
                                $scope.g.countDown();
                                $scope.info.code_id = res.data.data.id;
                            }
                        },$scope);
                    },
                    verifyCode: function(){
                        if($scope.info.loading){
                            return false;
                        }
                        if($scope.info.code == undefined || $scope.info.code == ''){
                            $scope.g.tip("message","Please enter the verification code");
                            return;
                        }
                        $.ajax({
                            loading: 2,
                            method: 'post',
                            data: {
                                code_id: $scope.info.code_id,
                                code: $scope.info.code,
                                national_code: $scope.info.country.d,
                                mobile: $scope.info.mobile
                            },
                            url: 'app/modules/dashboard/user/data/verify.code.php',
                            success: function(res){
                                $scope.info.getCandyInfo();
                                $scope.g.info.mobile_verified = true;
                                $scope.g.info.mobile = $scope.info.mobile;
                                $scope.g.info.mobile_national_code = '00' + $scope.info.country.d;
                            }
                        },$scope);
                    },
                    getCandyInfo: function(){
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            url: 'app/modules/dashboard/user/data/get.referral.reward.php',
                            success: function(res){
                                $scope.info.candyInfo = res.data.data;
                                $scope.info.eth_address = $scope.info.candyInfo.coin_address;
                            }
                        },$scope);
                    },
                    goEthAddress: function(){
                        $scope.info.ethAddress = true;
                    },
                    closeEthAddress: function(){
                        $scope.info.ethAddress = false;
                    },
                    ethSub: function(){
                        if($scope.info.loading){
                            return false;
                        }
                        if (!$scope.info.eth_address || !$scope.info.ethMatch($scope.info.eth_address)) {
                            $scope.info.errorText = 'Please enter the correct ETH wallet address！';
                            //$scope.info.message = "请输入正确ETH地址";
                            return false;
                        }

                        $.ajax({
                            loading: 2,
                            method: 'post',
                            data: {
                                eth_address: $scope.info.eth_address
                            },
                            url: 'app/modules/dashboard/user/data/bind.eth.address.php',
                            success: function(res){
                                $scope.g.tip("message", "Binding Success");
                                $scope.info.candyInfo.coin_address = $scope.info.eth_address;
                                $scope.info.candyInfo.reward = ($scope.info.candyInfo.reward + res.data.data.airdrop_remain_reward);
                            }
                        },$scope);
                    },
                    ethMatch: function(address){
                        address = address.toLocaleLowerCase();
                        if (!/^(0x)?[0-9a-f]{40}$/i.test(address)) {
                            // check if it has the basic requirements of an address
                            return false;
                        } else if (/^(0x)?[0-9a-f]{40}$/.test(address) || /^(0x)?[0-9A-F]{40}$/.test(address)) {
                            // If it's all small caps or all all caps, return true
                            return true;
                        } else {
                            // Otherwise check each case
                            return false;
                        }
                    },
                    clearError: function(){
                        $scope.info.errorText = "";
                    },
                    copySuccess: function(){
                        $scope.g.tip("message","Copy success");
                    }
                };

                for(var i in $scope.info.countryList){
                    //console.log($scope.info.countryList[i].n.length);
                    if($scope.info.countryList[i].d == "86"){
                        $scope.info.country = $scope.info.countryList[i];
                    }
                }
                console.log($scope.info.countryList);

                userInfo.get().then(function(userInfo){
                    console.log(userInfo);
                    if(userInfo.data.mobile_verified == 1){
                        $scope.g.info.mobile_verified = true;
                        $scope.info.getCandyInfo();
                    }
                });
            }]
        }
    }
};