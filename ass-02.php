<?php
/**
     * ID:602110198
     * Name: Jingrong Zhuang
     * WeChat: Rz
     */

require __DIR__ . './vendor/autoload.php';

$opt=getopt('s:t:h',['step:','to','help'],$optind);
$argu=array_slice($_SERVER['argv'],$optind);
$filename=$_SERVER['argv'][0];

foreach([
    ['s','step'],
    ['t','to'],
    ['h','help'],
] as list($shortn,$longn)){
    if (!array_key_exists($longn,$opt) && array_key_exists($shortn,$opt)){
        $opt[$longn]=$opt[$shortn];
    }
}

if(array_key_exists('help',$opt))
    printf("%s\n",<<<EOF
Usage: php {$filename} [options] [--] start end
Options:
  -s|--step=increasing  specific increasing value.
                        if not specified increase by 1.
  -t|--to=currency      convert to currency, case-insensitive:
                        CNY for Chinese Yuan.
                        USD for United States dollar.
                        EUR for Euro.
                        if not specified convert to Chinese Yuan.
  -h|--help print this manual.
Arguments:
  start                 specific starting.
  end                   specific maximum (show value <= end).
                        invalid if start > end.
EOF
    );
     
if($opt==null)
{
if ($argu==null){
        printf("%s\n",<<<EOT
        Invalid arguments!!!
        Usage the following command for help.
        php {$filename} -h
        EOT
    );exit(1);
    }
else
    {
        if ($argu[0]>$argu[1])
        {
        printf("%s\n",<<<EOT
        Invalid arguments!!!
        Usage the following command for help.
        php {$filename} -h
        EOT
    );exit(1);
        }
        else 
        {   foreach([
            ['step',1],
            ['to','CNY']
        ] as list($name,$default)){
        if (!array_key_exists($name,$opt))
            $opt[$name]=$default;}
            $converter = new CurrencyConverter\CurrencyConverter;
            $exchangerate=$converter->convert('THB', 'CNY');
            printf("              THB              CNY\n");
            for($i=$argu[0];$i<=$argu[1];$i++){
                printf("%17.2f",$i);
                printf("%17.2f\n",$i*$exchangerate);
            }
    
        }}
}
else{
if (array_key_exists('step',$opt) && is_numeric($opt['step'])){
    $converter = new CurrencyConverter\CurrencyConverter;
    if (!array_key_exists('to',$opt)){
    $exchangerate=$converter->convert('THB', 'CNY');
    printf("              THB              CNY\n");
    for($i=$argu[0];$i<=$argu[1];$i=$i+$opt['step']){
    printf("%17.2f",$i);
    printf("%17.2f\n",$i*$exchangerate);
            }}
    
    else{
       $input=strtoupper($opt['to']);
       if ($input=='USD') {
       $converter = new CurrencyConverter\CurrencyConverter;
       $exchangerate=$converter->convert('THB', 'USD');
       for($i=$argu[0];$i<=$argu[1];$i=$i+$opt['step']){
        printf("%17.2f",$i);
        printf("%17.2f\n",$i*$exchangerate);}
       }
       else if ($input=='CNY') {
       $converter = new CurrencyConverter\CurrencyConverter;
       $exchangerate=$converter->convert('THB', 'CNY');
       for($i=$argu[0];$i<=$argu[1];$i=$i+$opt['step']){
        printf("%17.2f",$i);
        printf("%17.2f\n",$i*$exchangerate);}
       }
       else if ($input=='EUR'){
        $converter = new CurrencyConverter\CurrencyConverter;
        $exchangerate=$converter->convert('THB', 'EUR');
        for($i=$argu[0];$i<=$argu[1];$i=$i+$opt['step']){
         printf("%17.2f",$i);
         printf("%17.2f\n",$i*$exchangerate);}
       }
       else printf("%s\n",<<<EOT
       Invalid arguments!!!
       Usage the following command for help.
       php {$filename} -h
       EOT
           );
}}
else {
       $input=strtoupper($opt['to']);
       if ($input=='USD') {
       $converter = new CurrencyConverter\CurrencyConverter;
       $exchangerate=$converter->convert('THB', 'USD');
       for($i=$argu[0];$i<=$argu[1];$i++){
        printf("%17.2f",$i);
        printf("%17.2f\n",$i*$exchangerate);}
       }
       else if ($input=='CNY') {
       $converter = new CurrencyConverter\CurrencyConverter;
       $exchangerate=$converter->convert('THB', 'CNY');
       for($i=$argu[0];$i<=$argu[1];$i++){
        printf("%17.2f",$i);
        printf("%17.2f\n",$i*$exchangerate);}
       }
       else if ($input=='EUR'){
        $converter = new CurrencyConverter\CurrencyConverter;
        $exchangerate=$converter->convert('THB', 'EUR');
        for($i=$argu[0];$i<=$argu[1];$i++){
         printf("%17.2f",$i);
         printf("%17.2f\n",$i*$exchangerate);}
       }
       else printf("%s\n",<<<EOT
       Invalid arguments!!!
       Usage the following command for help.
       php {$filename} -h
       EOT
           );
}
}