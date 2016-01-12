<?php

class Price extends ConnectDB {
    public static function importPrice($files,$sklad) {
        $delete = parent::$DBH->prepare("DELETE FROM provider_price WHERE sklad=$sklad");
        $delete->execute();

        $handle = fopen($files['csv']['tmp_name'], "r");
        $import = parent::$DBH->prepare("INSERT INTO provider_price (id, sklad, brand, nomer, name, price, kol) VALUES(NULL,:sklad,:brand,:nomer,:name,:price,:kol)");
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $nomer = self::replaceNomer($data[1]);
            $import->bindParam(':sklad', $sklad);
            $import->bindParam(':brand', mb_convert_encoding($data[0],"UTF-8","Windows-1251"));
            $import->bindParam(':nomer', $nomer);
            $import->bindParam(':name', mb_convert_encoding($data[2],"UTF-8","Windows-1251"));
            $import->bindParam(':price', $data[3]);
            $import->bindParam(':kol', $data[4]);
            $import->execute();
        }
        fclose($handle);
    }

    function replaceNomer($nomer) {
        $nomer = str_replace(' ', '', $nomer);
        $nomer = str_replace('-', '', $nomer);
        $nomer = str_replace('.', '', $nomer);
        return $nomer;
    }
} 