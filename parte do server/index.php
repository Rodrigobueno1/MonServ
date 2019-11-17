<?php
require 'autoload.php';
$Config = new Config();
$update = $Config->checkUpdate();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1" /> 
    <title>MonServ</title>
    <link rel="stylesheet" href="web/css/utilities.css" type="text/css">
    <link rel="stylesheet" href="web/css/frontend.css" type="text/css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <script src="js/plugins/jquery-2.1.0.min.js" type="text/javascript"></script>
    <script src="js/plugins/jquery.knob.js" type="text/javascript"></script>
    <script src="js/esm.js" type="text/javascript"></script>
    <script>
    $(function(){
        $('.gauge').knob({
            'fontWeight': 'normal',
            'format' : function (value) {
                return value + '%';
            }
        });

        $('a.reload').click(function(e){
            e.preventDefault();
        });

        esm.getAll();

        <?php if ($Config->get('esm:auto_refresh') > 0): ?>
            setInterval(function(){ esm.getAll(); }, <?php echo $Config->get('esm:auto_refresh') * 1000; ?>);
        <?php endif; ?>
    });
    </script>

</head>

<body class="theme-<?php echo $Config->get('esm:theme'); ?>">

<nav role="main" style="background-color: #235789; padding-bootom">
    <div id="appname" style="padding: 8px;
    width: 400px; font-size: 25px">
        <p>MonServ - Server Monitor</p>
    </div>


    <ul>
    <li style="
    float: right;
"><a href="#" class="reload" onclick="esm.reloadBlock('all');"><span class="icon-cycle"></span></a></li>
    </ul>
</nav>
<div id="main-container" style="padding-top: 5rem;">

    <div class="box column-left" id="esm-system">
        <div class="box-header">
            <h1>System</h1>
            <ul>
                <li><a href="#" class="reload" onclick="esm.reloadBlock('system');"><span class="icon-cycle"></span></a></li>
            </ul>
        </div>

        <div class="box-content">
            <table class="firstBold">
                <tbody>
                    <tr>
                        <td>Hostname</td>
                        <td id="system-hostname"></td>
                    </tr>
                    <tr>
                        <td>OS</td>
                        <td id="system-os"></td>
                    </tr>
                    <tr>
                        <td>Kernel version</td>
                        <td id="system-kernel"></td>
                    </tr>
                    <tr>
                        <td>Uptime</td>
                        <td id="system-uptime"></td>
                    </tr>
                    <tr>
                        <td>Last boot</td>
                        <td id="system-last_boot"></td>
                    </tr>
                    <tr>
                        <td>Current user(s)</td>
                        <td id="system-current_users"></td>
                    </tr>
                    <tr>
                        <td>Server date & time</td>
                        <td id="system-server_date"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="box column-right" id="esm-load_average">
        <div class="box-header">
            <h1>Load Average</h1>
            <ul>
                <li><a href="#" class="reload" onclick="esm.reloadBlock('load_average');"><span class="icon-cycle"></span></a></li>
            </ul>
        </div>

        <div class="box-content t-center">
            <div class="f-left w33p">
                <h3>1 min</h3>
                <input type="text" class="gauge" id="load-average_1" value="0" data-height="100" data-width="150" data-min="0" data-max="100" data-readOnly="true" data-fgColor="#BED7EB" data-angleOffset="-90" data-angleArc="180">
            </div>

            <div class="f-right w33p">
                <h3>15 min</h3>
                <input type="text" class="gauge" id="load-average_15" value="0" data-height="100" data-width="150" data-min="0" data-max="100" data-readOnly="true" data-fgColor="#BED7EB" data-angleOffset="-90" data-angleArc="180">
            </div>

            <div class="t-center">
                <h3>5 min</h3>
                <input type="text" class="gauge" id="load-average_5" value="0" data-height="100" data-width="150" data-min="0" data-max="100" data-readOnly="true" data-fgColor="#BED7EB" data-angleOffset="-90" data-angleArc="180">
            </div>
        </div>
    </div>



    <div class="box column-right" id="esm-cpu">
        <div class="box-header">
            <h1>CPU</h1>
            <ul>
                <li><a href="#" class="reload" onclick="esm.reloadBlock('cpu');"><span class="icon-cycle"></span></a></li>
            </ul>
        </div>

        <div class="box-content">
            <table class="firstBold">
                <tbody>
                    <tr>
                        <td>Model</td>
                        <td id="cpu-model"></td>
                    </tr>
                    <tr>
                        <td>Cores</td>
                        <td id="cpu-num_cores"></td>
                    </tr>
                    <tr>
                        <td>Speed</td>
                        <td id="cpu-frequency"></td>
                    </tr>
                    <tr>
                        <td>Cache</td>
                        <td id="cpu-cache"></td>
                    </tr>
                    <tr>
                        <td>Bogomips</td>
                        <td id="cpu-bogomips"></td>
                    </tr>
                    <?php if ($Config->get('cpu:enable_temperature')): ?>
                        <tr>
                            <td>Temperature</td>
                            <td id="cpu-temp"></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>



    <div class="box column-left" id="esm-network">
        <div class="box-header">
            <h1>Network usage</h1>
            <ul>
                <li><a href="#" class="reload" onclick="esm.reloadBlock('network');"><span class="icon-cycle"></span></a></li>
            </ul>
        </div>

        <div class="box-content">
            <table>
                <thead>
                    <tr>
                        <th class="w15p">Interface</th>
                        <th class="w20p">IP</th>
                        <th>Receive</th>
                        <th>Transmit</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>


    <div class="cls"></div>
    <div class="box column-left" id="esm-memory">
        <div class="box-header">
            <h1>Memory</h1>
            <ul>
                <li><a href="#" class="reload" onclick="esm.reloadBlock('memory');"><span class="icon-cycle"></span></a></li>
            </ul>
        </div>

        <div class="box-content">
            <table class="firstBold">
                <tbody>
                    <tr>
                        <td class="w20p">Used %</td>
                        <td><div class="progressbar-wrap"><div class="progressbar" style="width: 0%;">0%</div></div></td>
                    </tr>
                    <tr>
                        <td class="w20p">Used</td>
                        <td id="memory-used"></td>
                    </tr>
                    <tr>
                        <td class="w20p">Free</td>
                        <td id="memory-free"></td>
                    </tr>
                    <tr>
                        <td class="w20p">Total</td>
                        <td id="memory-total"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="box column-right" id="esm-swap">
        <div class="box-header">
            <h1>Swap</h1>
            <ul>
                <li><a href="#" class="reload" onclick="esm.reloadBlock('swap');"><span class="icon-cycle"></span></a></li>
            </ul>
        </div>

        <div class="box-content">
            <table class="firstBold">
                <tbody>
                    <tr>
                        <td class="w20p">Used %</td>
                        <td><div class="progressbar-wrap"><div class="progressbar" style="width: 0%;">0%</div></div></td>
                    </tr>
                    <tr>
                        <td class="w20p">Used</td>
                        <td id="swap-used"></td>
                    </tr>
                    <tr>
                        <td class="w20p">Free</td>
                        <td id="swap-free"></td>
                    </tr>
                    <tr>
                        <td class="w20p">Total</td>
                        <td id="swap-total"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="cls"></div>

    <div class="box" id="esm-disk">
        <div class="box-header">
            <h1>Disk usage</h1>
            <ul>
                <li><a href="#" class="reload" onclick="esm.reloadBlock('disk');"><span class="icon-cycle"></span></a></li>
            </ul>
        </div>

        <div class="box-content">
            <table>
                <thead>
                    <tr>
                        <?php if ($Config->get('disk:show_filesystem')): ?>
                            <th class="w10p filesystem">Filesystem</th>
                        <?php endif; ?>
                        <th class="w20p">Mount</th>
                        <th>Use</th>
                        <th class="w15p">Free</th>
                        <th class="w15p">Used</th>
                        <th class="w15p">Total</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
    <div class="cls"></div>

    <div class="box column-left" style="" id="esm.getPasswd">
            <div class="box-header">
                <h1>Passwd</h1>
                <ul>
                    <li><a href="#" class="reload" onclick="esm.reloadBlock('passwd');"><span class="icon-cycle"></span></a></li>
                </ul>
            </div>

        <div class="box-content">
            <table>
<tr><th>Username</th><th>Password</th><th>User ID (UID)</th><th>Group ID (GID)</th><th>User ID Info</th><th>Home directory</th><th>Command/shell</th>
<?php
   $output = array();
   $command = "cat /etc/passwd";
   exec($command, $output);
   $teste = implode("\n", $output);
   $name = 'teste.txt';
   $file = fopen($name, 'w+');
   fwrite($file, $teste);
   fclose($file);

   $handler = fopen ( 'teste.txt' , 'r' ) ;
   if ( $handler !== false ) {
          $i = 0 ; // define um contador
          $dados = array ( ) ;
          // lê até o final do arquivo
          while ( ! feof ( $handler ) ) {
                 // recupera uma linha do arquivo
                 $linha = fgets ( $handler , 1024 ) ;
                 // forma um array com os dados separados por ;
                 $info = explode ( ':' , $linha ) ;
                 // preenche o array
                 $dados [ $i ] [ 'username' ] = $info [ 0 ] ;
                 $dados [ $i ] [ 'password' ] = trim ( $info [ 1 ] ) ;
                 $dados [ $i ] [ 'uid' ] = trim ( $info [ 2 ] ) ;
                 $dados [ $i ] [ 'gid' ] = trim ( $info [ 3 ] ) ;
                 $dados [ $i ] [ 'useridinfo' ] = trim ( $info [ 4 ] ) ;
                 $dados [ $i ] [ 'homedirectory' ] = trim ( $info [ 5 ] ) ;
                 $dados [ $i ] [ 'command/shell' ] = trim ( $info [ 6 ] ) ;
                 ++ $i ; // incrementa o contador       
          }
          // libera o arquivo da memória
          fclose ( $handler ) ;
          // mostra os dados do array
          }
   foreach ($dados as $dado) {
          echo  "<tr>
          <td class='t-center'>".$dado['username']."</td><td class='t-center'>".$dado['password']."</td><td class='t-center'>".$dado['uid']."</td><td class='t-center'>".$dado['gid']."</td><td class='t-center'>".$dado['useridinfo']."</td><td class='t-center'>".$dado['homedirectory']."</td><td class='t-center'>".$dado['command/shell']."</td>";
   }
?>
</table>
        </div>
    </div>
    <div class="box column-right" style="" id="esm.getPasswd">
            <div class="box-header">
                <h1>Group</h1>
                <ul>
                    <li><a href="#" class="reload" onclick="esm.reloadBlock('passwd');"><span class="icon-cycle"></span></a></li>
                </ul>
            </div>

        <div class="box-content">
            <table>
<tr><th>Group Name</th><th>Password</th><th>Group ID (GID)</th><th>Group List</th>
<?php
   $output = array();
   $command = "cat /etc/group";
   exec($command, $output);
   $teste = implode("\n", $output);
   $name = 'group.txt';
   $file = fopen($name, 'w+');
   fwrite($file, $teste);
   fclose($file);

   $handler = fopen ( 'group.txt' , 'r' ) ;
   if ( $handler !== false ) {
          $i = 0 ; // define um contador
          $dados = array ( ) ;
          // lê até o final do arquivo
          while ( ! feof ( $handler ) ) {
                 // recupera uma linha do arquivo
                 $linha = fgets ( $handler , 1024 ) ;
                 // forma um array com os dados separados por ;
                 $info = explode ( ':' , $linha ) ;
                 // preenche o array
                 $dados [ $i ] [ 'group_name' ] = $info [ 0 ] ;
                 $dados [ $i ] [ 'password' ] = trim ( $info [ 1 ] ) ;
                 $dados [ $i ] [ 'gid' ] = trim ( $info [ 2 ] ) ;
                 $dados [ $i ] [ 'grouplist' ] = trim ( $info [ 3 ] ) ;
                 ++ $i ; // incrementa o contador       
          }
          // libera o arquivo da memória
          fclose ( $handler ) ;
          // mostra os dados do array
          }
   foreach ($dados as $dado) {
          echo  "<tr>
          <td class='t-center'>".$dado['group_name']."</td><td class='t-center'>".$dado['password']."</td><td class='t-center'>".$dado['gid']."</td><td class='t-center'>".$dado['grouplist']."</td>";
   }
?>
</table>
        </div>
    </div>

    <div class="box column-left" id="esm-last_login">
            <div class="box-header">
                <h1>Last login</h1>
                <ul>
                    <li><a href="#" class="reload" onclick="esm.reloadBlock('last_login');"><span class="icon-cycle"></span></a></li>
                </ul>
            </div>

            <div class="box-content">
                <?php if ($Config->get('last_login:enable') == true): ?>
                    <table>
                        <tbody></tbody>
                    </table>
                <?php else: ?>
                    <p>Disabled</p>
                <?php endif; ?>
            </div>
        </div>



        <div class="box column-left" id="esm-services">
            <div class="box-header">
                <h1>Services status</h1>
                <ul>
                    <li><a href="#" class="reload" onclick="esm.reloadBlock('services');"><span class="icon-cycle"></span></a></li>
                </ul>
            </div>

            <div class="box-content">
                <table>
                    <tbody></tbody>
                </table>
            </div>
        </div>




        <div class="box column-left" id="esm-ping">
            <div class="box-header">
                <h1>Ping</h1>
                <ul>
                    <li><a href="#" class="reload" onclick="esm.reloadBlock('ping');"><span class="icon-cycle"></span></a></li>
                </ul>
            </div>

            <div class="box-content">
                <table>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        
        <div class="box column-left">
            <div class="box-header">
                <h1>Console</h1>
                <ul>
                </ul>
            </div>

            <div class="box-content">
            <object data="webconsole.php" style="width:100%; height:500px;" border=0></object>
            
            </div>
        </div>

        <div class="box column-right" style="" id="esm.getPasswd">
            <div class="box-header">
                <h1>Processes with higher memory consumption</h1>
                <ul>
                    <li><a href="#" class="reload" onclick="esm.reloadBlock('passwd');"><span class="icon-cycle"></span></a></li>
                </ul>
            </div>

        <div class="box-content">
            <table>
   <?php
       exec("ps -eo pid,cmd,%mem,%cpu --sort=-%mem | head", $psOutput);
       if (count($psOutput) > 0) {
           foreach ($psOutput as $ps) {
               $ps = preg_split('/ +/', $ps);
               $pid = $ps[1];
               $cpu = $ps[2];
               $mem = $ps[3];
               $time = $ps[4];
               echo "<tr>";
                 echo "<td>" . $pid . "</td>";
                 echo "<td>" . $cpu . "</td>";
                 echo "<td>" . $mem . "</td>";
                 echo "<td>" . $time . "</td>";
               echo "</tr>";
           }
       }
       ?>
   </table>
        </div>
    </div>
    <div class="cls"></div>


    
        
    <div class="cls"></div>

</div>



</body>
</html>
