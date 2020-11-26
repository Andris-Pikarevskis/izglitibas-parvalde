<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="apple-touch-icon" sizes="180x180" href="Pictures/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="Pictures/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="Pictures/favicon/favicon-16x16.png">
    <link rel="manifest" href="Pictures/favicon/site.webmanifest">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <main>
        <header class="header">
        </header>

        <form action="action.php" method="POST">
        <div class="Rectangle1">
            <div class="sign-up">Daugavpils izglītības pārvaldes mājas lapu izvērtējums MK noteikumu nr: 445
                atbilstībai.</div>
        </div>
        <div class="information-blocks">
            <div class="information-fields">
                <div class="Rectangle2">
                        <h2 class="block-title">Piekļūstamības paziņojums</h2>
                        <div class="ievades-lauki">
                                <div class="name">
                                    <input type="text" name="name" placeholder="iestādes nosaukums">

                                </div>
                                <div class="name">
                                    <input type="text" name="url" placeholder="norādīt tīmekļvietnes adresi – URL">
                                </div>
                                <div class="name">
                                    <input type="text" name="method" placeholder="izmantotā izvērtēšanas metode">
                                </div>
                                <div class="name">
                                    <input type="text" name="protocol_url" placeholder="saite uz izvērtējumu apliecinošu protokolu">
                                </div>
                        </div>

                </div>
            </div>
            <div class="information-fields">
            <div class="Rectangle2">
                    <h2 class="block-title">Atbilstības status</h2>
                    <button type="button" class="add-more-fit-status">Add more (+)</button>
                    <br>
                    <div class="text2">Atzīmēt vajadzīgo – atbilstoši izvēlētajam statusam:</div><br>
                    <div class="ievades-lauli">
                            <input type="checkbox" name="if_fit_status[]" value="1">
                            <label for="">pilnīgi atbilst </label><br>
                            <input type="checkbox" name="if_fit_status[]" value="0">
                            <label for="">neatbilst </label><br>
                            <input type="checkbox" name="if_fit_status[]" value="2">
                            <label for="">daļēji atbilst </label>

                            <div class="name">
                                <input type="text" name="fit_url[]" placeholder="Tīmekļvietne">
                                <textarea rows="15" name="fit_reason[]"
                                placeholder="norādīt neatbilstošo saturu vai pamatot atbrīvojumu, norādot attiecīgos minēto noteikumu punktus"></textarea>
                            </div>
                    </div>
                </div>
            <div class="more-fit-status-container">
            </div>
            </div>
            <div class="information-fields">
                <div class="Rectangle2">
                    <h2 class="block-title">Nepiekļūstamais saturs</h2><br>
                    <div class="text2">Atzīmēt vajadzīgo – atbilstoši izvēlētajam statusam:</div><br>
                    <div class="ievades-lauki">
                            <input type="checkbox" name="if_inaccessible_content" value="0">
                            <label for="">Neatbilstība prasībām</label><br>
                            <input type="checkbox" name="if_inaccessible_content" value="1">
                            <label for="">piekļūstamības prasību nodrošināšana rada nesamērīgu slogu</label><br>
                            <input type="checkbox" name="if_inaccessible_content" value="2">
                            <label for="">Uz saturu neattiecas noteikumu prasības</label>

                            <div class="name">
                                <input type="text" name="inaccessible_url" placeholder="Tīmekļvietne">
                                <textarea rows="15" cols="38" name="inaccessible_reason"
                                    placeholder="norādīt tīmekļvietņu neatbilstības un norādīt, kuras sadaļas/saturs/funkcijas nav atbilstošas piekļūstamības prasībām."></textarea>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="rectangle3">
            <div class="down-block1">
                <h2 class="block-title">Piekļūstamības alternatīvas</h2><br>
                <div class="text2">(atbilstoši atbilstības statusam un nepiekļūstamajam saturam)</div><br>
                <div class="ievades-lauki">
                        <div class="name">
                            <textarea rows="4" cols="38" name="access_alternative"
                                placeholder="norādīt tīmekļvietņu neatbilstības un norādīt, kuras sadaļas/saturs/funkcijas nav atbilstošas piekļūstamības prasībām."></textarea>
                        </div>
                </div>

            </div>

            <div class="down-block2">
                <h2 class="block-title">Ziņas par paziņojuma sagatavošanu</h2><br><br>
                <div class="ievades-lauki">
                        <div class="name">
                            <textarea rows="4" cols="38" name="note_first_date"
                                placeholder="(norādīt PIRMREIZĒJĀ paziņojuma sagatavošanas datumu)"></textarea><br>
                            <textarea rows="4" cols="38" name="note_remind_date"
                                placeholder="(norādīt paziņojuma ATKRTOTĀ pārskatīšanas datumu; nenorāda, ja šis ir pirmreizējais paziņojums)"></textarea><br>
                        </div>
                </div>
            </div>
            <input type="submit" name="submitForm" class="button" value="submit">

        </div>
        
        </form>
    </main>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $('.add-more-fit-status').click(function() {
        $('.more-fit-status-container').append(
            '<div class="Rectangle2"><div class="text2">Atzīmēt vajadzīgo – atbilstoši izvēlētajam statusam:</div><div class="ievades-lauki"><input type="checkbox" name="if_fit_status[]" value="1"><label for="">pilnīgi atbilst </label><br><input type="checkbox" name="if_fit_status[]" value="0"><label for="">neatbilst </label><br><input type="checkbox" name="if_fit_status[]" value="2"><label for="">daļēji atbilst </label><div class="name"><input type="text" name="fit_url[]" placeholder="Tīmekļvietne"><textarea rows="15" name="fit_reason[]" placeholder="norādīt neatbilstošo saturu vai pamatot atbrīvojumu, norādot attiecīgos minēto noteikumu punktus"></textarea></div></div></div>'
        );
    });
</script>
</html>