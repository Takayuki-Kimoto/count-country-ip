# count-country-ip
==============================

## 概要
------------------------------
ipアドレスから国コードのアクセス数を集計するツールです。  
ほとんど利用機会は無いけど、hadoopでipアドレスを抽出 → 国別にアクセス数を見たい場合など  

## setup
------------------------------
1.GeoLite2を取得 (countryの方)

    wget http://geolite.maxmind.com/download/geoip/database/GeoLite2-Country.mmdb.gz
    gunzip GeoLite2-Country.mmdb.gz

2.GeoLite2のパスを修正する (src/main.php)

    $getliteMmdb = __DIR__ . '/../GeoLite2-Country.mmdb';
                    # ↑ ここを実際のパスに修正

3.GeoLite2のAPIをインストール (composer install)

    composer install


## 実行
------------------------------
1.実行コマンド

    php /count-country-ip/src/main.php /log/ipaddress-list.log
                                         # ↑ ipアドレスのリストlogを指定

2.入力ファイルのフォーマット  
・ヘッダーなしの  
　[ipアドレス]タブ区切り[カウント数]  
/----------------------------------------------

    192.168.30.123	2
    193.281.59.211	1
    212.28.182.452
                   ↑ カウント数は無くても良い
/----------------------------------------------

## 結果
------------------------------
1.出力先

    /count-country-ip/count-country.txt

2.出力先の変更 (src/main.php)

    $outputfile = __DIR__ . '/../count-country.txt';
                    # ↑ ここを修正



## end
