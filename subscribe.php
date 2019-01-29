<?php
/*
消息订阅者，即subscribe客户端，需要独占链接，即进行subscribe期间，redis-client无法穿插其他操作，
此时client以阻塞的方式等待“publish端”的消息，所以我们用命令行来执行
*/

set_time_limit(0);
ignore_user_abort(true);

$redis = new Redis();
if (!$redis->connect('127.0.0.1',6379)){
    exit('链接失败');
}
$redis->setOption(Redis::OPT_READ_TIMEOUT,-1); //设置永远不超时

$redis->subscribe(['message_channel'],function($instance, $channelName, $message){
    echo $channelName.'=>'.$message."\r\n";
});
