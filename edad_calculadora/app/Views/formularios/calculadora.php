
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>

      .container {
        width:1080px;
        margin:0px auto;
        font-size:1em;
        font-family: "Arial", Georgia, Serif;
        font-size: 15px;
      }
      header {
        text-align:center;
        border: 1px solid #ccc;
        background: #fafafa
      }
      h3 {
        font-size: 40px;
      }
      a {
        color: #333;
        text-decoration: none;
      }
      section,aside {
        padding: 10px;
        -moz-border-radius:3px;-webkit-border-radius:3px;-o-border-radius:3px;border-radius:3px;
      }
      section {
        float: left;
        width: 55%;
      }
      aside {
        float: right;
        width: 40%;
        color: #333;
      }
      nav {
        overflow: hidden;
        background:#444;
        margin-top: 0.5%;
        margin-bottom: 0.5%;
      }
      nav ul {
        list-style-type:none;
        float:left;
        padding:0px;
        width: 100%;
        display: table;
        text-align: center;
      }
      nav ul li {
        display: inline-block;
        float: none;
        padding:8px 10px;
        margin:2px;
        background:#e52020;
        -moz-border-radius:3px;-webkit-border-radius:3px;-o-border-radius:3px;border-radius:3px;
        border: solid 1px #fafafa;
      }
      nav ul li:hover {
        background-color: #333;
      }
      nav a {
      display:block;
      text-align:center;
      text-decoration:none;
      color: #fafafa;
      }
      form {
        width: 100%;
        max-width: 400px;
        text-align: center;
        border: solid 1px #c2c2c2;
        padding-bottom: 10px;
        margin: auto;
        background: #fafafa;
      }
      input[type=textfield] {
          width: 75%;
          padding: 16px 32px;
          font-size: 16px;
          margin: 8px 0;
          border: 1px solid silver;
          border-radius: 1px;
          text-align: left;
          color: #333;
          background: #c2c2c2;
      }
      input[type=button], input[type=submit], input[type=reset] {
          background-color: #ba2b2b;
          border: none;
          color: white;
          padding: 16px 32px;
          font-size: 16px;
          min-width: 21%;
          text-decoration: none;
          margin: 4px 2px;
          cursor: pointer;
      }
      input[type=button]:hover, input[type=submit]:hover, input[type=reset]:hover {
        background-color: #521414;
      }

      footer {
        position: fixed;
        Width: 100%;
        right: 0;
        bottom: 0;
        left: 0;
        padding: 10px 0px 10px 0px;
        background-color: #333;
        text-align: center;
      }
      footer a {
        color: #fff;
      }

      
      @media screen and (max-width:980px) {
        .container {
          width:98%;
        }
        section {
          width:68%;
        }
      }

      
      @media screen and (max-width:700px) {
        aside,section {
          float:none;
          width:96%;
          font-size:1.2em;
        }
        nav, section {
          font-size:1.2em;
        }
        aside {
          margin-top:5px;
          background:#fafafa;
          color: #333;
        }
        nav ul {
          float:none;
          clear:both;
        }
      }

      
      @media screen and (max-width:480px) {
        aside {
          display:block;
          background:#fafafa;
          color: #333;
          font-size:1.5em;
        }
        nav, section {
          font-size:1.5em;
        }
        section {
          width:94%;
        }
        nav ul {
          display: table;
          text-align: center;
          float: none;
          width:100%;
        }
        nav ul li {
          float:none;
        }
      }



    </style>
</head>
<body>

  <form name="calculator" method="POST" action="http://localhost/codeigniter4/public/formularios/calculadora">
    <h3>Calculadora</h3>
    <input type="textfield" name="ans" value="<?php if(!empty($resultado)) echo $resultado; ?>">
    <br>
    <input type="button" value="1" onClick="document.calculator.ans.value+='1'">
    <input type="button" value="2" onClick="document.calculator.ans.value+='2'">
    <input type="button" value="3" onClick="document.calculator.ans.value+='3'">
    <input type="button" value="+" onClick="document.calculator.ans.value+='+'">
    <br>
    <input type="button" value="4" onClick="document.calculator.ans.value+='4'">
    <input type="button" value="5" onClick="document.calculator.ans.value+='5'">
    <input type="button" value="6" onClick="document.calculator.ans.value+='6'">
    <input type="button" value="-" onClick="document.calculator.ans.value+='-'">
    <br>
    <input type="button" value="7" onClick="document.calculator.ans.value+='7'">
    <input type="button" value="8" onClick="document.calculator.ans.value+='8'">
    <input type="button" value="9" onClick="document.calculator.ans.value+='9'">
    <input type="button" value="*" onClick="document.calculator.ans.value+='*'">
    <br>
    <input type="button" value="0" onClick="document.calculator.ans.value+='0'">
    <input type="button" value="c" onClick="document.calculator.ans.value=''"> 
 
    <input type="button" value="/" onClick="document.calculator.ans.value+='/'">
    <input type="submit" value="=">
    
    </form>
</body>
</html>

 
