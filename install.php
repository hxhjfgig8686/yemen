<?php
// install.php

require_once __DIR__ . '/api/config.php';
require_once __DIR__ . '/api/db.php';

echo "<pre style='direction: ltr; background: #f4f4f4; padding: 20px; font-family: monospace;'>";
echo "馃殌 亘丿亍 鬲孬亘賷鬲 賳馗丕賲 SMS API...\n\n";

try {
    // 毓乇囟 賲毓賱賵賲丕鬲 丕賱丕鬲氐丕賱
    echo "馃搳 賲毓賱賵賲丕鬲 丕賱丕鬲氐丕賱 亘賯丕毓丿丞 丕賱亘賷丕賳丕鬲:\n";
    echo "  鈥� Host: " . DB_HOST . "\n";
    echo "  鈥� Database: " . DB_NAME . "\n";
    echo "  鈥� User: " . DB_USER . "\n\n";
    
    $conn = db();
    
    // 賯乇丕亍丞 賲賱賮 SQL
    if (file_exists('install.sql')) {
        $sql = file_get_contents('install.sql');
        
        // 鬲賯爻賷賲 賵鬲賳賮賷匕 丕賱兀賵丕賲乇
        $queries = array_filter(array_map('trim', explode(';', $sql)));
        $count = 0;
        foreach ($queries as $query) {
            if (!empty($query) && strpos($query, 'CREATE') === 0) {
                $conn->exec($query);
                $count++;
            }
        }
        echo "鉁� 鬲賲 廿賳卮丕亍 $count 噩丿賵賱 亘賳噩丕丨\n";
    } else {
        echo "鈿狅笍  賲賱賮 install.sql 睾賷乇 賲賵噩賵丿\n";
    }
    
    echo "\n馃摑 亘賷丕賳丕鬲 丕賱丿禺賵賱:\n";
    echo "  鈥� API Key: sk_cc1480ac5e3a4818e07fb4b0674bc2a72228372220dba26ac4579cfd4eda903b\n";
    echo "  鈥� Admin Username: admin\n";
    echo "  鈥� Admin Password: password\n\n";
    
    echo "馃敆 乇賵丕亘胤 賲賴賲丞:\n";
    $base_url = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://{$_SERVER['HTTP_HOST']}";
    echo "  鈥� 丕賱爻賷乇賮乇: {$base_url}\n";
    echo "  鈥� 丕禺鬲亘丕乇 API: {$base_url}/get_codes?api_key=sk_cc1480ac5e3a4818e07fb4b0674bc2a72228372220dba26ac4579cfd4eda903b\n";
    echo "  鈥� 賱賵丨丞 丕賱鬲丨賰賲: {$base_url}/admin/\n\n";
    
    echo "鉁� 丕賱鬲孬亘賷鬲 鬲賲 亘賳噩丕丨!\n";
    echo "鈿狅笍  賲賴賲: 丕丨匕賮 賲賱賮 install.php 亘毓丿 丕賱鬲孬亘賷鬲!\n";
    
} catch(PDOException $e) {
    echo "鉂� 禺胤兀 賮賷 丕賱鬲孬亘賷鬲: " . $e->getMessage() . "\n";
    echo "\n馃敡 賳氐丕卅丨 賱賱丨賱:\n";
    echo "  鈥� 鬲兀賰丿 賲賳 兀賳 賯丕毓丿丞 丕賱亘賷丕賳丕鬲 賲賵噩賵丿丞\n";
    echo "  鈥� 鬲兀賰丿 賲賳 氐丨丞 亘賷丕賳丕鬲 丕賱丕鬲氐丕賱\n";
    echo "  鈥� 鬲丨賯賯 賲賳 兀賳 MySQL 卮睾丕賱\n";
}
echo "</pre>";
?>