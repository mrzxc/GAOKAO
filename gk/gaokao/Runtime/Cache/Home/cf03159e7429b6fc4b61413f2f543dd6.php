<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="/gaokao/Public/css/bootstrap.min.css" rel="stylesheet">
    <style >
    .denglu{
      margin-left: 400px;
      display: inline;
    }
 ul{
      height: 68px;
      margin: 0;
      padding: 0;
      list-style: none;
      padding-top: 10px;
    }
    h3{
      color: black;
    }
    p{
      margin: 0;
      padding: 0;
      display: inline;
    }
    li.first{
      float: left;
      position: relative;
      height: 68px;
      padding:0;
      margin:0;
    }
    li.second {
      float: left;
      height: 55px;
      font-family: KaiTi;
      font-size: 40px;
      width: calc(100% - 80px);
      border-bottom: 5px solid #55c28b;
    }
    .tu{
      display: inline;
      margin-top: 10px;
    }
    .biaoti {
      float: left;
    }
    .status {
      float: right;
    }
    .form{
      margin-top: 50px;
      border-color: #55c28b;
    }
    .green {
      height: 150px;
      background-color: #55c28b;
    }
    .formdiv {
      width: 40%;
      margin: 50px auto 20px auto;
      height: 250px;
      border: 3px solid #55c28b;
    }
    .formdiv form {
      margin-left: 30%;
    }
    .formdiv form div {
      margin: 5% 0;
    }
    .formdiv form div label {
      display: inline-block;
      width: 43px;
      margin-right: 40px;
    }
    .formdiv form div input {
      border: 3px solid #55c28b;
    }
    .formdiv button {
      margin-top: 3%;
      width: 25%;
      height: 18%;
      border-radius: 40px;
      border: 2px solid rgba(20,20,20,0.5);
    }
    #log {
      margin-left: 35%;
      margin-right: 3%;
    }
    .mid {
      width: 80%;
      height: 80px;
      border: 3px solid #55c28b;
      margin-left: 10%;
    }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <header><ul>
    <li class="first"><img src="/gaokao/Public/img/yq.png" width="80" height="50"></li>
    <li class="second"><div class="biaoti">云起高考信息服务平台</div><div class="status"><?php echo ($status); ?></div></li>
  </ul></header>
    <div class="green"></div>
    <div class="formdiv">
      <form id="logfm" action="/gaokao/index.php/Home/Login" method="post">
        <div>
          <label for="username">帐号</label><input name="username" type="text">
        </div>
        <div>
          <label class="pass" for="password">密码</label><input name="password" type="password">
        </div>
      </form>
      <button type="submit" id="log">登录</button>
      <!-- <button id="reg"><a href="/gaokao/index.php/Home/Register">注册</a></button> -->
    </div>
    <div class="mid"></div>
    <script src="/gaokao/Public/js/jquery.min.js"></script>
    <script>
      $logbtn = $("#log");
      $logfm = $("#logfm")
      $logbtn.click(function(){
        $logfm.submit();
      });
    </script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
  </body>
</html>