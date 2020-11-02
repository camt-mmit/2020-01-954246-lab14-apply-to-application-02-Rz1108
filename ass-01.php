<?php
/**
     * ID:602110198
     * Name: Jingrong Zhuang
     * WeChat: Rz
     */

require __DIR__ . './vendor/autoload.php';

$opt= getopt('h',['help'],$optind);
foreach (
    ['h','help'] as list($shortn,$longn)){
        if (!array_key_exists($longn,$opt)&&array_key_exists($shortn,$opt))
        $opt[$longn]=$opt[$shortn];
    }


$args = array_slice($_SERVER['argv'], $optind);
$scripname=$_SERVER['argv'][0];

if ($args==null){
if (array_key_exists('help',$opt)){
    printf("%s\n", <<<EOT
    Usage: php {$scripname} [options] [--] file_name
    Options:
      -h|--help            print this manual.
    Arguments:
      file_name            specific file name with following format.
                           number_of_data
                           data1
                           data2
                           ...
    EOT
);exit(0);
}
else printf("%s\n",<<<EOT
Invalid arguments!!!
Usage the following command for help.
php {$scripname} -h
EOT
);exit(1);
}
else
{
    if (file_exists($args[0])){
        printf("              THB              CNY\n");
        $converter = new CurrencyConverter\CurrencyConverter;
        $exchangerate=$converter->convert('THB', 'CNY');
        $file=fopen($args[0],'r');
        $n=(int)trim(fgets($file));
        for ($i=0;$i<$n;$i++){
            $THB=trim(fgets($file));
            $CNY=$THB*$exchangerate;
            printf("%17s",number_format($THB,2,'.',','));
            printf("%17s\n",number_format($CNY,2,'.',','));
        }
    }
    else
     printf("%s\n",<<<EOT
    Cannot open file '{$args[0]}'!!!
    EOT
);exit(1);
}






