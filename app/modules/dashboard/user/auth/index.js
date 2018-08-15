/**
 * Created by Hajay on 2018/1/2.
 */
require("/app/common/lib/date/date.js");
module.exports = {
    url: '/auth',
    views: {
        'user': {
            template: __inline('index.html'),
            controller: ['$scope', '$http', '$cookies', '$state', '$', 'userInfo', 'FileUploader', '$translate', 'ZipImage', function($scope, $http, $cookies, $state, $, userInfo, FileUploader, $translate, ZipImage){
                $scope.g.currPage = 'user';
                $scope.userInfo.menu = "auth";

                $scope.info = {
                    uploadNum: 0,
                    loading: false,
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
                    //authLevel: $scope.userInfo.authLevel,
                    currentLevel: null, //当前等级
                    pending_status: 1,//0表示审核中，1表示未提交审核, 2表示审核失败
                    beingLevel:null, //认证中的等级
                    params:{},
                    tierParams:{
                        verify_source: 0 //默认中国
                    },
                    photoListC:['/common/images/icon-card-01.png','/common/images/icon-card-02.png','/common/images/icon-card-03.png'],
                    photoList:['/common/images/icon-card-04.png','/common/images/icon-card-05.png','/common/images/icon-card-06.png'],
                    getCurrentLevel: function(){
                        var self_ = this;
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            url: 'app/modules/dashboard/user/data/get.tier.php',
                            success: function(res){
                                var data = res.data.data;
                                console.log(data);
                                // self_.currentLevel = 0;
                                self_.currentLevel = data.auth_level;
                                self_.pending_status = !data.pending_level ? 1 : data.pending_status;
                            }
                        },$scope);
                    },
                    goAuth: function(level){
                        var this_ = this;
                        if(level==3){ //获取基本信息
                            if (this_.currentLevel == 0) return;
                            this_.getAuthInfo();
                        }
                        $scope.userInfo.authLevel = level;
                    },
                    step: 1,
                    goPrev: function(step){
                        if(step==0 || step==3){
                            $scope.userInfo.authLevel = step;//返回身份认证首页
                            return ;
                        }
                        $scope.info.step = step || 1;
                    },
                    submitAuth: function(){
                        if($scope.info.loading){
                            return false;
                        }
                        $scope.info.loading = true;
                        if($scope.info.mobile_verified!=1){
                            $scope.info.params.country = $scope.info.country.n;
                            $scope.info.params.mobile_national_code = $scope.info.country.d;
                        }
                        $.ajax({
                            loading: 2,
                            method: 'post',
                            data: $scope.info.params,
                            url: 'app/modules/dashboard/user/data/verify.tier01.php',
                            success: function(res){
                                $scope.info.loading = false;
                                $scope.info.currentLevel = parseInt($scope.info.currentLevel) + 1;
                                if($scope.userInfo.authLevel==1){
                                    var title,text;
                                    if($scope.g.currLang == 'cn'){
                                        title = "身份认证／认证1级";
                                        text = "您已完成认证1级。";
                                    }
                                    else {
                                        title = "Verification / Verify for Tier 1";
                                        text = "You have completed vertification tier 1."; 
                                    }
                                    $scope.g.info.mobile = $scope.info.params.mobile;//保留手机号码
                                    $scope.g.showTipClose = false;//不显示提示框关闭图标
                                    $scope.g.tip(title, text, function(){
                                        $scope.userInfo.authLevel = 0;//返回身份认证首页的代码
                                        $scope.g.showTipClose = true;
                                    });
                                }
                                else {
                                    $scope.info.step = 2;
                                }
                            }
                        },$scope);
                    },
                    getCode: function(type){ //获取验证码 @type ===>当前认证的等级
                        var self_ = $scope.info;
                        var gInfo = $scope.g.info;
                        if(type==2 && !self_.flag(0)) return;//验证
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            data: {
                                national_code: gInfo.mobile_national_code || '00' + self_.country.d,
                                mobile: gInfo.mobile || self_.params.mobile
                            },
                            url: 'app/common/data/get.sms.code.php',
                            success: function(res){
                                $scope.g.countDown();
                                self_.params.sms_id = res.data.data.id;
                            }
                        },$scope);
                    },
                    saveAuth: function(){ //保存基本信息
                        var self_ = this;
                        //验证数据
                        var regDate = /^[1-9]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
                        if(!self_.params.birth_date || !regDate.test(self_.params.birth_date)){
                            if($scope.g.currLang=="en"){
                                $scope.g.tip("message"," Date of Birth Incorrect format");
                            }else{
                                $scope.g.tip("提示","出生日期格式不对");
                            }
                            return false;
                        }
                        //接保存信息的接口
                        self_.saveAuthInfo();
                        console.log($scope.info.tierParams.verify_source);
                        // isEnter = self_.tierParams.verify_source == 0 ? cnIsEnter : enIsEnter;
                        // console.log("_" + isEnter);
                    },
                    changeNum: function(num){ //上传图片
                        $scope.info.uploadNum = num;
                    },
                    getAuthInfo: function(){ //获取基本信息
                        var self_  = this;
                        self_.mobile_verified = 0;//可编辑
                        $.ajax({
                            loading: 1,
                            method: 'post',
                            url: 'app/modules/dashboard/user/data/get.tier01.info.php',
                            success: function(res){
                                self_.params = res.data.data;
                                for(key in self_.countryList){
                                    var country = self_.countryList[key];
                                    if(country.n == self_.params.country){
                                        self_.country = country;
                                        self_.params.country = country.n;
                                        self_.params.mobile_national_code = country.d;
                                    }
                                }
                                self_.tierParams.verify_source = self_.params.country == 'China (中国)' ? 0 : 1;
                            }
                        },$scope);
                    },
                    saveAuthInfo: function(){ //保存基本信息数据
                        var self_ = this;
                        self_.tierParams.verify_source = self_.country.n == 'China (中国)' ? 0 : 1;
                        self_.tierParams.reserved_mobile_national_code = '00' + self_.country.d;

                        if($scope.info.mobile_verified!=1){ //在不可编辑的情况下获取值
                            self_.params.country = self_.country.n;
                            self_.params.mobile_national_code = self_.country.d;
                        }

                        $.ajax({
                           loading: 1,
                           method: 'post',
                           data: self_.params,
                           url: 'app/modules/dashboard/user/data/modify.tier01.php',
                           success: function(res){
                                //console.log(res);
                                //保存成功后跳转到下一步
                                self_.goAuth(4);
                           }
                        },$scope);
                    },
                    saveTierInfo: function(){ //保存认证数据
                        var self_ = this;
                        self_.loading = true;
                        if(!self_.flag()) return;//验证
                        uploader.uploadAll();

                        self_.tierParams.sms_id = self_.params.sms_id;
                        $.ajax({
                           loading: 2,
                           method: 'post',
                           data: self_.tierParams,
                           url: 'app/modules/dashboard/user/data/verify.tier02.php',
                           success: function(res){
                                //保存成功后跳转到下一步
                                $scope.userInfo.authLevel = 0;
                                self_.pending_status = 0;
                           }
                        },$scope);
                    },
                    flag: function(type){ //验证   @type ===> 0不验证验证码   1可以不传参
                        var self_ = this;
                        var lang  = $scope.g.currLang;
                        var lang_ = self_.tierParams.verify_source;
                        
                        if(lang_ == 0){//中国
                            if(!self_.tierParams.id_card_number){
                                if(lang == "en"){
                                    $scope.g.tip("message"," Please enter the ID number");
                                }else{
                                    $scope.g.tip("提示","请输入身份证号码");
                                }
                                self_.loading = false;
                                return false;
                            }else{
                                if(!self_.isCardNo(self_.tierParams.id_card_number)){
                                    if(lang == "en"){
                                        $scope.g.tip("message","ID card input is illegal");
                                    }else{
                                        $scope.g.tip("提示","身份证输入不合法");
                                    }
                                    self_.loading = false;
                                    return false;
                                }
                            }
                            if(type != 0 && !self_.tierParams.sms_code){
                                if(lang == "en"){
                                    $scope.g.tip("message","Please enter SMS verification code");
                                }else{
                                    $scope.g.tip("提示","请输入短信验证码");
                                }
                                self_.loading = false;
                                return false;
                            }
                            if(uploader.queue.length != 3){
                                if(lang == "en"){
                                    $scope.g.tip("message","Please upload your ID photo");
                                }else{
                                    $scope.g.tip("提示","请上传身份证照片");
                                }
                                self_.loading = false;
                                return false;
                            }
                        }else{
                            if(!self_.tierParams.passport_number){
                                if(lang == "en"){
                                    $scope.g.tip("message"," Please enter your passport number");
                                }else{
                                    $scope.g.tip("提示","请输入护照号码");
                                }
                                self_.loading = false;
                                return false;
                            }else{
                                if(!self_.isPassportNo(self_.tierParams.passport_number)){
                                    if(lang == "en"){
                                        $scope.g.tip("message","Passport number input is illegal");
                                    }else{
                                        $scope.g.tip("提示","护照号码输入不合法");
                                    }
                                    self_.loading = false;
                                    return false;
                                }
                            }
                            if(uploader.queue.length != 3){
                                if(lang == "en"){
                                    $scope.g.tip("message","Please upload passport photos");
                                }else{
                                    $scope.g.tip("提示","请上传护照照片");
                                }
                                self_.loading = false;
                                return false;
                            }
                        }
                        return true;
                    },
                    isCardNo: function(card){//验证身份证
                        // 身份证号码为15位或者18位，15位时全为数字，18位前17位为数字，最后一位是校验位，可能为数字或字符X 
                        var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/; 
                        return reg.test(card);
                    },
                    isPassportNo: function(card){
                        //var reg = /^((1[45]\d{7})|(G\d{8})|(P\d{7})|(S\d{7,8}))?$/;
                        var reg = /^[A-Za-z0-9]+$/;
                        return reg.test(card);
                    },
                    dateChange: function(k, v) {// 输入验证
                        var self_ = this;
                        if(k == 'date'){// 出生日期
                            var regDate = /^[1-9]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
                            if(v == ''){
                                self_.date = {
                                    error: $translate.instant('130046')
                                };
                            }else if(!regDate.test(v)){// 验证日期格式
                                self_.date = {
                                    error: $translate.instant('130047')
                                };
                            }else{
                                self_.date = {
                                    error: ''
                                };
                            }
                        }else if(k == 'date'){

                        }
                        
                    }
                };
                
                $scope.info.getCurrentLevel();//获取用户等级
                userInfo.get().then(function(userInfo){
                    $scope.info.mobile_verified = $scope.g.info.mobile_verified;
                    if($scope.info.mobile_verified==1){
                        $scope.info.params.mobile = $scope.g.info.mobile;
                        $scope.info.params.mobile_national_code = $scope.g.info.mobile_national_code.substr(2);
                        //根据手机区号获取国籍
                        for(key in $scope.info.countryList){
                            var country = $scope.info.countryList[key];
                            if(country.d==$scope.info.params.mobile_national_code){
                                $scope.info.country = country;
                                $scope.info.params.country = country.n;
                            }
                        }
                    }
                });

                var dateData = {
                    id: 'getDate',
                    callbackFun: function(returnData){
                        if(returnData){
                            $scope.$apply(function(){
                                $scope.info.params.birth_date = returnData.date.split("-")[0];
                            });
                        }
                    },
                    show_hour: false,
                    hide_range: true,
                    hide_month: true,
                    hide_week: true,
                    hide_day: true,
                    in_id: true
                };
                // window.dt(dateData);

                //uploader
                var uploader = $scope.info.uploader = new FileUploader({
                    url: 'app/common/data/upload.php',
                    //autoUpload: true
                });
                uploader.filters.push({
                    name: 'imageFilter',
                    fn: function(item /*{File|FileLikeObject}*/, options) { 
                        //if (item.size > 3145728) {
                        //    if($scope.g.currLang == "cn"){
                        //        $scope.g.tip("提示", '文件超过3M');
                        //    }else{
                        //        $scope.g.tip("error", 'File cannot be larger than 3M');
                        //    }
                        //    return false;
                        //}
                        var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
                        return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
                    }
                });
                uploader.onAfterAddingFile = function(fileItem) {
                    console.log(fileItem);
                    var index_ = $scope.info.uploadNum;
                    var lang_  = $scope.info.tierParams.verify_source;
                    var reader = new FileReader();
                    reader.addEventListener("load", function (e) {
                        //文件加载完之后，更新angular绑定
                        $scope.$apply(function(){
                            if(lang_ == 1){
                                $scope.info.photoList[index_] = e.target.result;
                            }else{
                                $scope.info.photoListC[index_] = e.target.result;
                            }
                        });

                        var url = 'app/common/data/upload.php?type=';
                        //uploader.queue[index_] = fileItem;

                        //压缩图片
                        ZipImage.resizeFile(fileItem._file).then(function(blob_data) {
                            fileItem._file = blob_data;
                            console.log(1111)
                            console.log(fileItem)
                            uploader.queue[index_] = fileItem;
                            var arrList = fileItem.file.name.split('.');
                            var lastSecond = arrList[arrList.length-1];
                            if(lang_ == 1){
                                uploader.queue.length > 3 ? uploader.queue.pop() : '';//删除最后一个
                                if(index_ == 0){
                                    url += 'passport_cover';
                                    $scope.info.tierParams.passport_cover = 'passport_cover.' + lastSecond;
                                }else{
                                    if(index_ == 1){
                                        url += 'passport_personal_info';
                                        $scope.info.tierParams.passport_personal_info = 'passport_personal_info.' + lastSecond;
                                    }else{
                                        url += 'hand_held_passport';
                                        $scope.info.tierParams.hand_held_passport = 'hand_held_passport.' + lastSecond;
                                    }

                                }

                            }else{
                                uploader.queue.length > 3 ? uploader.queue.pop() : '';//删除最后一个
                                if(index_ == 0){
                                    url += 'id_front_photo';
                                    $scope.info.tierParams.id_front_photo = 'id_front_photo.' + lastSecond;
                                }else{
                                    if(index_ == 1){
                                        url += 'id_back_photo';
                                        $scope.info.tierParams.id_back_photo = 'id_back_photo.' + lastSecond;
                                    }else{
                                        url += 'hand_held_card';
                                        $scope.info.tierParams.hand_held_card = 'hand_held_card.' + lastSecond;
                                    }
                                }

                            }
                            uploader.queue[index_].uploader.url = url;
                            uploader.queue[index_].url = url;
                        }, function(err_reason) {
                            console.log(err_reason);
                        });


                    }, false);
                    reader.readAsDataURL(fileItem._file);
                    console.log($scope.info.tierParams);
                };
            }]
        }
    },
    resolve : {
        "auth": ['$ocLazyLoad', function($ocLazyLoad) {
            // you can lazy load files for an existing module
            return $ocLazyLoad.load({
                name: 'auth',
                serie: true,
                files: [
                    '/app/common/lib/date/date.css',
                    // '/dashboard/common/lib/date/date.js',
                    '../bower_components/angular-file-upload/dist/angular-file-upload.js',
                ]
            });
        }]
    }
};