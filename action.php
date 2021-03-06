<?php
include 'inc/config.php';

global $db;

$data = [
    'name' => isset($_POST['name']) ? $_POST['name'] : '',
    'url' => isset($_POST['url']) ? $_POST['url'] : '',
    'method' => isset($_POST['method']) ? $_POST['method'] : '',
    'protocol_url' => isset($_POST['protocol_url']) ? $_POST['protocol_url'] : '',
    'if_fit_status' => isset($_POST['if_fit_status']) ? $_POST['if_fit_status'] : '',
    'fit_url' => isset($_POST['fit_url']) ? $_POST['fit_url'] : '',
    'fit_reason' => isset($_POST['fit_reason']) ? $_POST['fit_reason'] : '',
    'if_inaccessible_content' => isset($_POST['if_inaccessible_content']) ? $_POST['if_inaccessible_content'] : '',
    'inaccessible_url' => isset($_POST['inaccessible_url']) ? $_POST['inaccessible_url'] : '',
    'inaccessible_reason' => isset($_POST['inaccessible_reason']) ? $_POST['inaccessible_reason'] : '',
    'access_alternative' => isset($_POST['access_alternative']) ? $_POST['access_alternative'] : '',
    'note_first_date' => isset($_POST['note_first_date']) ? $_POST['note_first_date'] : '',
    'note_remind_date' => isset($_POST['note_remind_date']) ? $_POST['note_remind_date'] : '',
];

$json = json_encode($data, JSON_UNESCAPED_UNICODE);

if(isset($_POST['submitForm'])) {

    $insertData = array (
        'content' => json_encode($data, JSON_UNESCAPED_UNICODE), 
        'updated_at' => $db->now(),
        'created_at' => $db->now()
    );

    $lastId = $db->insert('content', $insertData);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/output.css">
</head>

<?php

$id = ($lastId > 0) ? $lastId : (int) $_GET['id'];
$query = sprintf("SELECT * FROM content WHERE id = %s", $id);
$data = $db->rawQuery($query);

// if (empty($data[0]['content']) || $id == 0) {
//         exit('Wrong id' );
// }

$data = json_decode($data[0]['content'], false);

?>
<body>
        <h2>Piekļūstamības paziņojums</h2>
        <p><input type="text" name="" placeholder="iestādes nosaukums" class="iestades-nosaukums" value="<?= $data->name; ?>"> saskaņā ar</p>
        <p>Ministru kabineta 2020. gada 14. jūlija noteikumiem Nr. 445 "Kārtība, kādā iestādes ievieto informāciju internetā" (turpmāk - noteikumi Nr. 445) apņemas savu tīmekļvietni/<br>mobilo lietotni (pasvītrot vajadzīgo) veidot piekļūstamu.</p>
        <p>Šis paziņojums attiecas uz: 
        <input type="text" name=""
            placeholder="(norādīt tīmekļvietnes/mobilās lietotnes adresi - URL; var būt vairākas)"
            class="iestades-nosaukums" 
            value="<?= $data->url; ?>"></p>
        <p><br /> Izvērtējums tika veikts, izmantojot: 
        <input type="text" name="" placeholder="(norādīt izmantoto izvērtēšanas metodi; ja izmantotas atšķirīgas metodes, norādīt visas atbilstoši to izmantošanai)" class="iestades-nosaukums" value="<?= $data->method; ?>"></p>
        <p><br /> Izvērtējumu apliecinošs dokuments: 
        <input type="text" name="" placeholder="(pievienot hipersaiti uz izvērtējumu apliecinošu dokumentu, protokolu, pārskatu vai citu līdzvērtīgu dokumentu)" class="iestades-nosaukums" value="<?= $data->protocol_url; ?>"></p>
        <br><br><h2>Atbilstības statuss</h2>
        <p><em>Atzīmēt vajadzīgo - vienu no Šādiem veidiem</em>:</p>


        <?php

        $str = '';

        foreach ($data->if_fit_status as $k => $v) {
                if ($v == 1) {
                        $str .='<p>Tīmekļvietne</p><br><p><input type="checkbox" id="" name="" value="" checked><strong> pilnīgi atbilst </strong>noteikumiem Nr: 445</p>';
                        $str .= sprintf('<p><div class="iestades-nosaukums1 pre-wrap">%s</div></p>', $data->fit_url[$k]);
                }

                if ($v == 2) {
                        $str .= '<p><br /> Tīmekļvietne</p><p><strong><input type="checkbox" id="" name="" value="" checked> daļēji atbilst </strong>noteikumiem Nr: 445 šādu neatbilstību/atbrīvojumu dēļ:</p>';
                        $str .= (!empty($data->fit_url[$k])) ? sprintf('<p><input type="text" name="" placeholder="(var norādīt vairākas tīmekļvietnes un/vai mobilās lietotnes)" class="iestades-nosaukums1" value="%s"></p>', $data->fit_url[$k]) : '';
                        //$str .= (!empty($data->fit_reason[$k])) ? sprintf('<p><textarea rows="15" placeholder="(norādīt neatbilstošo saturu vai pamatot atbrīvojumu, norādot attiecīgos minēto noteikumu punktus)" class="iestades-nosaukums1">%s</textarea></p>',  $data->fit_reason[$k]) : '';
                        $str .= (!empty($data->fit_reason[$k])) ? sprintf('<p><div class="iestades-nosaukums1 pre-wrap">%s</div></p>',  $data->fit_reason[$k]) : '';
                }

                if ($v == 0) {
                        $str .= '<p><br />Tīmekļvietne</p><p><strong><input type="checkbox" name="" value="" checked> neatbilst </strong>noteikumiem Nr: 445 šādu neatbilstību/atbrīvojumu dēļ:</p>';
                        $str .= (!empty($data->fit_url[$k])) ? sprintf('<p> <input type="text" name="" placeholder="(var norādīt vairākas tīmekļvietnes)" class="iestades-nosaukums1" value="%s"></p>', $data->fit_url[$k]) : '';
                        $str .= (!empty($data->fit_reason[$k])) ? sprintf('<p><div class="iestades-nosaukums1 pre-wrap">%s</div></p>', $data->fit_reason[$k]) : '';
                }
        }

?>

        <?= $str; ?>

        <h2>Nepiekļūstamais saturs</h2>
        <br><p><em>Atzīmēt vajadzīgo - vienu no šādiem veidiem atbilstoši izvēlētajam atbilstības statusam</em>:</p><br>

<?php 
        
        if ($data->if_inaccessible_content == 0) {
                echo '<p><strong><input type="checkbox" name="" value="" checked>Neatbilstība prasībām</strong>, kas minētas noteikumos Nr. 445</p>';
                echo (!empty($data->inaccessible_url)) ? sprintf('<p> <input type="text" name="" class="iestades-nosaukums1" value="%s"></p>', $data->inaccessible_url) : '';
                echo sprintf('<p><div class="iestades-nosaukums1 pre-wrap">%s</div></p><br>', $data->inaccessible_reason);
        }

        if ($data->if_inaccessible_content == 1) {
                echo '<p><input type="checkbox" name="" value="" checked; ?>>Noteikumos Nr. 445 minēto <strong>piekļūstamības prasību nodrošināšana rada nesamērīgu slogu</strong></p>';
                echo (!empty($data->inaccessible_url)) ? sprintf('<p> <input type="text" name="" class="iestades-nosaukums1" value="%s"></p>', $data->inaccessible_url) : '';
                echo sprintf('<p><div class="iestades-nosaukums1 pre-wrap">%s</div></p><br>', $data->inaccessible_reason);
        }
        
        if ($data->if_inaccessible_content == 2) {
                echo '<p><strong><input type="checkbox" name="" value="" checked>Neattiecas. </strong>Uz saturu neattiecas noteikumu Nr. 445 prasības</p>';
                echo (!empty($data->inaccessible_url)) ? sprintf('<p> <input type="text" name="" class="iestades-nosaukums1" value="%s"></p>', $data->inaccessible_url) : '';
                echo sprintf('<p><div class="iestades-nosaukums1 pre-wrap">%s</div></p><br>', $data->inaccessible_reason);
        }

?>
        
        
        <h2>Piekļūstamības alternatīvas</h2> 
        <div class="pieklustamibas-saturs">(atbilstoši atbilstības statusam un nepiekļūstamajam saturam)</div><br>
        <p><div class="iestades-nosaukums1 pre-wrap"><?= $data->access_alternative; ?></div></p><br>
        <h2>Ziņas par paziņojuma sagatavošanu </h2><br>

        <p>Pirmreizēji sagatavots:</p>
        <input type="text" name="" placeholder="(norādīt pirmreizējā paziņojuma sagatavošanas datumu)" class="iestades-nosaukums" value="<?= $data->note_first_date; ?>"></p>
        <br><br>
        
        <p>Atkārtoti pārskatīts: 
                <input type="text" name="" placeholder="(norādīt paziņojuma pēdējās pārskatīšanas datumu; nenorāda, ja šis ir pirmreizējais paziņojums)" class="iestades-nosaukums" value="<?= $data->note_remind_date; ?>">
        </p>

                
        <br><br> <h2>Atsauksmēm un saziņai</h2><br>
        <p><input type="text" name="" placeholder="(aprakstīt atsauksmju sniegšanas mehānismu un norādīt hipersaiti, kuru izmantojot iestādi var informēt " class="iestades-nosaukums1"></p> <br>
        <p><input type="text" name="" placeholder="par atbilstības nepilnībām un pieprasīt piekļūstamo informāciju vai saturu)" class="iestades-nosaukums1"></p><br>
        <p><input type="text" name="" placeholder="(norādīt kontaktinformāciju saziņai ar iestādi piekļūstamības jautājumos)" class="iestades-nosaukums1"></p><br><br>
        
        <h2>Izpildes nodrošināšanas procedūra un sūdzību iesniegšanas kārtība</h2>
        <p>(aprakstīt izpildes panākšanas procedūru iestādē (iesnieguma vai sūdzības par nepiekļūstamu saturu iesniegšanas un izpildes process) un, ja attiecināms, to<br> pārraugošajā iestādē;</p>
        <p>norādīt kontaktinformāciju saziņai ar izpildes nodrošinātāju (struktūrvienību))</p>
        
        <input type="text" name="" placeholder="" class="iestades-nosaukums1"><br>
        <p>Ja iestāde, kas atbildīga par attiecīgās tīmekļvietnes vai mobilās lietotnes saturu, nav atbilstoši reaģējusi uz lietotāja iesniegumu vai sūdzību par tīmekļvietnes satura<br> piekļūstamību, lietotājs var iesniegt sūdzību Latvijas Republikas Tiesībsargam:</p><br>
        <p><input type="text" name="" placeholder="(norādīt kontaktinformāciju saziņai ar Latvijas Republikas Tiesībsargu (hipersaite uz tīmekļvietni un tiesībsarga kontaktinformāciju))" class="iestades-nosaukums1"></p> <br>
        
        <div class="footer">Vides aizsardzības un<br>reģionālās attīstības ministrs J. Pūce</div>
</body>
</html>