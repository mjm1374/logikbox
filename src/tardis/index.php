<?php
	//include_once("../controller/Controller.php");
    //$controller = new Controller();
?>

	<!doctype html>
	<html class="no-js"  lang="en">
	<head>
		        <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <title>Tardis JS - Logikbox - Mike McAllister</title>

        <meta name="description" content="A Lightweight Javascript Date/Time Converter and Formatter">
        <meta name="viewport" content="width=device-width">
        <link href="https://fonts.googleapis.com/css?family=Archivo|Permanent+Marker|Shadows+Into+Light|Teko" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
        
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="css/tardis.css">
        <link rel="stylesheet" href="css/github-light.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="javascript/main.js"></script>
        <script src="javascript/tardis.js"></script>
		<link rel="canonical" href="http://tardis.logikbox.com/index.php"/>
	</head>
	<body>
         
    <div class="tardis container">
        <div class="row">
            <div class="col-sm-12 tardis__header">
                <img src="img/galefreyan.png" alt="tarids" />
                <div class="tardis__logo"></div>
            </div>
            <div class="col-sm-2"></div>
            <div class="col-sm-8 tardis__copy">
                <h1>Tardis JS</h1>
                <P>nimis montes reprobo esca praemitto fere distineo. sollicitudin tempor suscipit huic aliquip vehicula interdico. aliquam os accumsan iustum luctus ridiculus. fermentum delenit demoveo vitae ligula exerci ac. paratus eget lacinia eros modo tempor. tego probo vehicula ad ligula lobortis.</p>

                <h3>Install</h3>
                <p>Via NPM: <span class="code">npm i lbx-tardis</span></p>
                <p>or</p>
                <p>Include tardis.js in your build directory or link to it directly</p>
                <code>
                     
                        &lt;script type="text/javascript" src="tardis.js"&gt;&lt;/script&gt;
                   
                </code>
                <p>Download <a href="javascript/tardis.js.zip" title="Downlaod Tardis JS">tardis.js</a></p>

                <h3>Usage</h3>
                <p>magna cogo lacus mauris laoreet. iustum aliquam comis fusce jus mi rutrum. zelus praemitto capto leo augue tempor. roto consectetuer sollicitudin ibidem nostra virtus. regula venio elit luptatum pellentesque probo typicus nisl. te rusticus consectetur regula pertineo verto roto pagus. libero exputo zelus saepius quae valetudo oppeto pagus.</p>

                <h3>Filters</h3>
                <p>letalis ludus nisl interdum mi sodales. mollis abluo metuo saepius duis risus sagittis. tempor aliquet ultricies opes orem dictum abigo. modo eligo mi viverra egestas accumsan. condimentum cras gravida lectus sagittis.</P>

<div class="tardis__table tardis__filters code" style="width: 100%;" >
<div class="tardis__tableBody">
    <div class="tardis__tableRow">
    <div class="tardis__tableCell">YYYY</div>
    <div class="tardis__tableCell"><span class="pl-c1">thisDate</span>.<span class="pl-en">fullYear</span></div>
    <div class="tardis__tableCell">2019</div>
    <div class="tardis__tableCell">full 4 digit year</div>
    </div>
    <div class="tardis__tableRow">
    <div class="tardis__tableCell">YYY</div>
    <div class="tardis__tableCell"><span class="pl-c1">thisDate</span>.<span class="pl-en">wordYear</span></div>
    <div class="tardis__tableCell">two thousand and nineteen</div>
    <div class="tardis__tableCell">full english 4 digit year</div>
    </div>
    <div class="tardis__tableRow">
    <div class="tardis__tableCell">YY</div>
    <div class="tardis__tableCell"><span class="pl-c1">thisDate</span>.<span class="pl-en">shortYear</span></div>
    <div class="tardis__tableCell">19</div>
    <div class="tardis__tableCell">truncated string of YYYY</div>
    </div>
    <div class="tardis__tableRow">
    <div class="tardis__tableCell">y</div>
    <div class="tardis__tableCell"><span class="pl-c1">thisDate</span>.<span class="pl-en">year</span></div>
    <div class="tardis__tableCell">119</div>
    <div class="tardis__tableCell">integer value, no leading 0, years from 1970</div>
    </div>
    <div class="tardis__tableRow">
    <div class="tardis__tableCell">MMMM</div>
    <div class="tardis__tableCell"><span class="pl-c1">thisDate</span>.<span class="pl-en">fullMonth</span></div>
    <div class="tardis__tableCell">June</div>
    <div class="tardis__tableCell">name value of month from months array</div>
    </div>
    <div class="tardis__tableRow">
    <div class="tardis__tableCell">MMM</div>
    <div class="tardis__tableCell"><span class="pl-c1">thisDate</span>.<span class="pl-en">shortMonth</span></div>
    <div class="tardis__tableCell">Jun</div>
    <div class="tardis__tableCell">months[date.getMonth()].substr(0, 3)</div>
    </div>
    <div class="tardis__tableRow">
    <div class="tardis__tableCell">MM</div>
    <div class="tardis__tableCell"><span class="pl-c1">thisDate</span>.<span class="pl-en">MMonth</span></div>
    <div class="tardis__tableCell">06</div>
    <div class="tardis__tableCell">string value of month with leading 0</div>
    </div>
    <div class="tardis__tableRow">
    <div class="tardis__tableCell">M</div>
    <div class="tardis__tableCell"><span class="pl-c1">thisDate</span>.<span class="pl-en">month</span></div>
    <div class="tardis__tableCell">6</div>
    <div class="tardis__tableCell">integer value, no leading 0</div>
    </div>
    <div class="tardis__tableRow">
    <div class="tardis__tableCell">m</div>
    <div class="tardis__tableCell"><span class="pl-c1">thisDate</span>.<span class="pl-en">monthInt</span></div>
    <div class="tardis__tableCell">6</div>
    <div class="tardis__tableCell">integer value, no leading 0</div>
    </div>
    <div class="tardis__tableRow">
    <div class="tardis__tableCell">DDDD</div>
    <div class="tardis__tableCell"><span class="pl-c1">thisDate</span>.<span class="pl-en">fullDay</span></div>
    <div class="tardis__tableCell">Saturday</div>
    <div class="tardis__tableCell">name value of day or week from Days Array</div>
    </div>
    <div class="tardis__tableRow">
    <div class="tardis__tableCell">DDD</div>
    <div class="tardis__tableCell"><span class="pl-c1">thisDat</span>.<span class="pl-en">shortDay</span></div>
    <div class="tardis__tableCell">Sat</div>
    <div class="tardis__tableCell">truncated string of DDDD</div>
    </div>
    <div class="tardis__tableRow">
    <div class="tardis__tableCell">DD</div>
    <div class="tardis__tableCell"><span class="pl-c1">thisDate</span>.<span class="pl-en">DDay</span></div>
    <div class="tardis__tableCell">06</div>
    <div class="tardis__tableCell">string value of D with leading 0</div>
    </div>
    <div class="tardis__tableRow">
    <div class="tardis__tableCell">D</div>
    <div class="tardis__tableCell"><span class="pl-c1">thisDate</span>.<span class="pl-en">day</span></div>
    <div class="tardis__tableCell">6</div>
    <div class="tardis__tableCell">integer value, no leading 0</div>
    </div>
    <div class="tardis__tableRow">
    <div class="tardis__tableCell">D</div>
    <div class="tardis__tableCell"><span class="pl-c1">thisDate</span>.<span class="pl-en">dayInt</span></div>
    <div class="tardis__tableCell">1</div>
    <div class="tardis__tableCell">Day of week counter (Sun = 0, Sat = 6)</div>
    </div>
    <div class="tardis__tableRow">
    <div class="tardis__tableCell">HHHH</div>
    <div class="tardis__tableCell"><span class="pl-c1">thisDate</span>.<span class="pl-en">wordHour</span></div>
    <div class="tardis__tableCell">nine</div>
    <div class="tardis__tableCell">string value of english text for a number</div>
    </div>
    <div class="tardis__tableRow">
    <div class="tardis__tableCell">HH</div>
    <div class="tardis__tableCell"><span class="pl-c1">thisDate</span>.<span class="pl-en">HHour</span></div>
    <div class="tardis__tableCell">09</div>
    <div class="tardis__tableCell">string value of H with leading 0</div>
    </div>
    <div class="tardis__tableRow">
    <div class="tardis__tableCell">H</div>
    <div class="tardis__tableCell"><span class="pl-c1">thisDate</span>.<span class="pl-en">hour</span></div>
    <div class="tardis__tableCell">4</div>
    <div class="tardis__tableCell">integer value, no leading 0</div>
    </div>
    <div class="tardis__tableRow">
    <div class="tardis__tableCell">h</div>
    <div class="tardis__tableCell"><span class="pl-c1">thisDate</span>.<span class="pl-en">hourInt</span></div>
    <div class="tardis__tableCell">4</div>
    <div class="tardis__tableCell">integer value, no leading 0</div>
    </div>
    <div class="tardis__tableRow">
    <div class="tardis__tableCell">IIII</div>
    <div class="tardis__tableCell"><span class="pl-c1">thisDate</span>.<span class="pl-en">wordSec</span></div>
    <div class="tardis__tableCell">twenty one</div>
    <div class="tardis__tableCell">string value of english text for a number</div>
    </div>
    <div class="tardis__tableRow">
    <div class="tardis__tableCell">II </div>
    <div class="tardis__tableCell"><span class="pl-c1">thisDate</span>.<span class="pl-en">MMin</span></div>
    <div class="tardis__tableCell">30</div>
    <div class="tardis__tableCell">string value of I with leading 0</div>
    </div>
    <div class="tardis__tableRow">
    <div class="tardis__tableCell">I</div>
    <div class="tardis__tableCell"><span class="pl-c1">thisDate</span>.<span class="pl-en">min</span></div>
    <div class="tardis__tableCell">30</div>
    <div class="tardis__tableCell">integer value, no leading 0</div>
    </div>
    <div class="tardis__tableRow">
    <div class="tardis__tableCell">i</div>
    <div class="tardis__tableCell"><span class="pl-c1">thisDate</span>.<span class="pl-en">minInt</span></div>
    <div class="tardis__tableCell">30</div>
    <div class="tardis__tableCell">integer value, no leading 0</div>
    </div>
    <div class="tardis__tableRow">
    <div class="tardis__tableCell">SSSS</div>
    <div class="tardis__tableCell"><span class="pl-c1">thisDate</span>.<span class="pl-en">wordMin</span></div>
    <div class="tardis__tableCell">thirty three</div>
    <div class="tardis__tableCell">string value of english text for a number</div>
    </div>
    <div class="tardis__tableRow">
    <div class="tardis__tableCell">SS </div>
    <div class="tardis__tableCell"><span class="pl-c1">thisDate</span>.<span class="pl-en">sec</span></div>
    <div class="tardis__tableCell">05</div>
    <div class="tardis__tableCell">string value of S with leading 0</div>
    </div>
    <div class="tardis__tableRow">
    <div class="tardis__tableCell">S</div>
    <div class="tardis__tableCell"><span class="pl-c1">thisDate</span>.<span class="pl-en">sec</span></div>
    <div class="tardis__tableCell">45</div>
    <div class="tardis__tableCell">integer value, no leading 0</div>
    </div>
    <div class="tardis__tableRow">
    <div class="tardis__tableCell">s</div>
    <div class="tardis__tableCell"><span class="pl-c1">thisDate</span>.<span class="pl-en">secInt</span></div>
    <div class="tardis__tableCell">45</div>
    <div class="tardis__tableCell">integer value, no leading 0</div>
    </div>
    <div class="tardis__tableRow">
    <div class="tardis__tableCell">TT</div>
    <div class="tardis__tableCell"><span class="pl-c1">thisDate</span>.<span class="pl-en">hour</span></div>
    <div class="tardis__tableCell">AM/PM</div>
    <div class="tardis__tableCell">meridiem display - upper case </div>
    </div>
    <div class="tardis__tableRow">
    <div class="tardis__tableCell">tt</div>
    <div class="tardis__tableCell"><span class="pl-c1">thisDate</span>.<span class="pl-en">hour</span></div>
    <div class="tardis__tableCell">am/pm</div>
    <div class="tardis__tableCell">meridiem display -  lower case</div>
    </div>
    <div class="tardis__tableRow">
    <div class="tardis__tableCell"></div>
    <div class="tardis__tableCell"></div>
    <div class="tardis__tableCell"></div>
    <div class="tardis__tableCell"></div>
    </div>
</div>
</div>
<!-- tardis__table.com -->


                <h3>Presets</h3>
                <p>letalis ludus nisl interdum mi sodales. mollis abluo metuo saepius duis risus sagittis. tempor aliquet ultricies opes orem dictum abigo. modo eligo mi viverra egestas accumsan. condimentum cras gravida lectus sagittis.</P>
                
<code>
<pre>
<span class="pl-c1">tardis</span>.<span class="pl-en">ISO</span>(<span class="pl-smi">{date}</span>)                <span class="pl-c">// 2019-06-30</span>
<span class="pl-c1">tardis</span>.<span class="pl-en">ShortDate</span>(<span class="pl-smi">{date}</span>)          <span class="pl-c">// 06/30/2019</span>
<span class="pl-c1">tardis</span>.<span class="pl-en">LongDate</span>(<span class="pl-smi">{date}</span>)           <span class="pl-c">// Jun 30 2019</span>
<span class="pl-c1">tardis</span>.<span class="pl-en">DayMonthDate</span>(<span class="pl-smi">{date}</span>)       <span class="pl-c">// Thursday,  Decemeber 1, 2005</span>
<span class="pl-c1">tardis</span>.<span class="pl-en">MonthDateTime</span>(<span class="pl-smi">{date}</span>)      <span class="pl-c">// Decemeber 1, 2005 18:50</span>
<span class="pl-c1">tardis</span>.<span class="pl-en">MonthDateTime12</span>(<span class="pl-smi">{date}</span>)    <span class="pl-c">// Decemeber 1, 2005 6:50 PM</span>
<span class="pl-c1">tardis</span>.<span class="pl-en">MonthDate</span>(<span class="pl-smi">{date}</span>)          <span class="pl-c">// Decemeber 1, 2005</span>
<span class="pl-c1">tardis</span>.<span class="pl-en">TimeOfDay</span>(<span class="pl-smi">{date}</span>)          <span class="pl-c">// 14:00:53</span>
<span class="pl-c1">tardis</span>.<span class="pl-en">TimeOfDay12</span>(<span class="pl-smi">{date}</span>)        <span class="pl-c">// 2:01:31 PM</span>
<span class="pl-c1">tardis</span>.<span class="pl-en">Year</span>(<span class="pl-smi">{date}</span>)               <span class="pl-c">// 2019</span>
<span class="pl-c1">tardis</span>.<span class="pl-en">Month</span>(<span class="pl-smi">{date}</span>)              <span class="pl-c">// June</span>
<span class="pl-c1">tardis</span>.<span class="pl-en">Day</span>(<span class="pl-smi">{date}</span>)                <span class="pl-c">// Sunday</span>
</pre>
</code>
                

                
            </div>
            <div class="col-sm-2"></div>
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <footer>
                     Footer
                    
                </footer>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-38537843-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-38537843-1');
    </script>

</body>
</html>

