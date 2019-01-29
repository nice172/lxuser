<?php
//发布订阅
//实现广播用户消息
$redis = new Redis();
if (!$redis->connect('127.0.0.1',6379)){
    exit('链接失败');
}
// echo $redis->isConnected();

$redis->publish('message_channel','subscribe message_channel');

