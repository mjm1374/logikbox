<?php

if (!defined('PARENT')) {
  exit;
}

$dcount = 0;

//=========================
// CATEGORIES
//=========================

$DB->db_query("TRUNCATE TABLE `" . DB_PREFIX . "categories`");
$query = $DB->db_query("INSERT INTO `" . DB_PREFIX . "categories` (`id`, `title`, `en`, `metat`, `slug`, `ordr`, `user`, `pass`, `delts`, `display`) VALUES
(1, 'Category One', 'yes', 'Demo Category One', 'cat-one', 1, '', '', 0, 'no'),
(2, 'Category Two', 'yes', '', 'cat-two', 2, '', '', 0, 'no'),
(3, 'Category Three', 'yes', '', 'cat-three', 3, '', '', 0, 'no'),
(4, 'Category Four', 'yes', '', 'cat-four', 4, '', '', 0, 'no'),
(5, 'Category Five', 'yes', '', 'cat-five', 5, '', '', 0, 'no')", true);
if ($query === 'err') {
  $dataE[] = DB_PREFIX . 'categories';
  $ERR     = $DB->db_error(true);
  mswInsLog(DB_PREFIX . 'categories', $ERR[1], $ERR[0], __LINE__, __FILE__, $DB, 'Insert (Demo)');
  ++$count;
  ++$dcount;
}

//=========================
// JOURNALS
//=========================

include(REL_PATH . 'control/classes/class.datetime.php');
$DT = new dt();
$now = $DT->ts();
$rss = $DT->rss();
$pass = mswEnc(SECRET_KEY . 'test');
$DB->db_query("TRUNCATE TABLE `" . DB_PREFIX . "journals`");
$query = $DB->db_query("INSERT INTO `" . DB_PREFIX . "journals` (`id`, `staff`, `title`, `comms`, `encomms`, `addts`, `pubts`, `delts`, `published`, `rss`, `metat`, `slug`, `tags`, `stick`, `user`, `pass`, `en`) VALUES
(1, 0, 'Reasons why you should have a responsive design', 'Responsive websites are now starting to become today`s standards of web design and development, the reason is the huge increase of mobile browsing. When you are on the way home from work, whether you take public transport or a private vehicle, you will see a lot of people using the internet on there phones. Ok, perhaps some are playing games and checking there facebook, but a huge percentage of users who use the internet are on mobiles devices.\r\n\r\nI would say most websites would be better off being responsive as it will solve most problems when you view them on websites, some websites may benefit from having a mobile app, but lets not get into a mobile app vs responsive website in this article.\r\n\r\nIf responsive websites are build correctly, you will have a much better chance at converting sales as the user will have a better experience browsing your website.\r\n\r\nA few reasons why a responsive website is a good thing.\r\n\r\n1. Your website will look good on all devices, no need to pinch and zoom in of parts of your website, it is easy to use and the user can browse your whole website with using only the thumb, especially good when you are on the way home from work on a crowded train.\r\n\r\n2. Google likes it, you will hear arguments with SEO guys saying that responsive websites do and don`t get you extra buddy points with Google indexing your website higher. Which ever is true you would think with the way Google changes the algorithm, it would be coming in soon if not so already. If you make Google happy, they will usually make you happy.\r\n\r\n3. Cheaper than a mobile app, while in some cases a mobile app is better than a responsive website, majority of the time a responsive website is better for information and e-commerce websites.\r\n\r\nYou can have a website that will look almost exactly like what you would have on a mobile app, but cheaper and easier to access for your customers. It is easier for users to just view your website in a mobile browser than downloading a mobile app for your site.\r\n\r\n4. Website looks modern and up to date, websites these days are being built to be responsive by default. So if you have a responsive website, you customers will know you are up to date with the latest technologies. Having a website that looks like it was built in the 1990\'s will not look good for your customers, some may think your company might not be that successful or you are not around anymore.\r\n\r\n5. Easy to read on smaller devices, as all websites will align perfectly just how you want your cutomers to see themFree Web Content, you can have your customer view your entire website buy just using one thumb and not having to pinch and zoom in manually.\r\n\r\nThe quicker you can have your customers read your website the better.\r\n\r\n[b]by Caroline Murphy (Article kindly provided by articlesfactory.com)[/b]', 'no', " . $now . ", " . $now . ", 0, 'yes', '" . $rss . "', 'Maian Weblog Demo Article One', 'slug-1', 'responsive,website', 'no', '', '', 'yes'),
(2, 0, 'How I Became A Radio DJ In Japan', 'One day I bumped into a guy who I went to school with when I was an exchange student for one year here in Niigata, Japan. He\'d gotten into the dating business and asked me if I would be the MC at the dating parties which are where guys and girls come together and exchange profiles and get to meet each other. It\'s good because it gives them an opportunity to meet others.\r\n\r\nUnknown to me, a female spy from one of the other dating groups in town had joined the party to see how we run our parties. Luckily I was the MC at that party.  She turned out to be a high spirited person, and a person who was to be my partner for 18 months on radio. Her name was Ryoko Mizobuchi.\r\n\r\nRyoko whilst now working for her dating company had previously worked on radio as a DJ and wanted to return to radio. A new radio station covering the whole of the Niigata Prefecture was about to start and was advertising for staff. Without phoning the station for an appointment she went to the station burst through the doors and asked for a job as a DJ.\r\n\r\nRyoko got the job and the owner of the production company for the radio station asked her if she knew any foreigners that spoke Japanese well. She told him of me and one other guy. Now the guy I was doing the MC dating work for rang me and said, \'I\'m going to do a dating corner on this new radio station called FM Port, Niigata. The corner will be about love and dating and I want you to do the corner on the radio, so come with me to FM Port to talk with production company boss.\r\n\r\nI went with him to FM Port and for the 30 minutes we were there the boss of the production company spoke to me about lots of things. I didn\'t think it was an interview so I just talked and joked with the boss. I was then offered a job as a radio DJ, 4 hours on air everyday except Sunday! The boss told me to come back the following Tuesday for a final interview and test. Heck I didn\'t even know that our chat was an interview.\r\n\r\nI came back for the \'second interview\' the boss gave me some news to read and some topics to talk about. I entered the little radio booth, put on the headphones and started talking when a voice told me to turn the mic on. Yeah, I guess that would help! Anyway I got the job.\r\n\r\nThe contract stated that if I was late at any time that that would end the contract. Also that I had only 5 annual days off per year. I had a great time and continued to be a Japanese radio DJ going out to a possible listener population of 5,000Science Articles,000. (five million) for over 3500 total hours on air.  The production company changed and with it my job. I look forward to getting back on the air.\r\n\r\n[b]by Michael Brymer (Article kindly provided by articlesfactory.com)[/b]', 'no', " . $now . ", " . $now . ", 0, 'yes', '" . $rss . "', NULL, 'slug-2', 'radio,japan', 'no', 'test', '" . mswSQL($pass) . "', 'yes'),
(3, 0, 'Exploring one of England\'s few remaining ancient woodlands', 'The Forest of Dean is one of England`s few remaining ancient woodlands and well worth discovering on a Gloucestershire cottage holiday. \'The Forest\' as it is known locally has a distinct cultural identity situated on high land between the Severn and Wye valleys. It is composed of mixed woodland, predominantly oak although beech is also common and sweet chestnut has grown here for many centuries.\r\n\r\nWhen I approached it from the east, across the Severn at Gloucester, it seemed like I was entering a small, central European fairytale kingdom - the road climbing quickly and steeply through trees from the wide open valley. As I quickly found out cycling around the winding country lanes the Forest it is a surprisingly hilly area, although thankfully in short sections. However there is a wide-ranging network of well-constructed cycle paths which are particularly good for families. These routes make use of old railways lines which served the coal mines deep in the forest and therefore offer long stretches of flat and gentle gradients. The Family Cycle Trail is an 11-mile circular route that takes you around the heart of the Forest. This route has been especially surfaced and is suitable for all ages and abilities.\r\n\r\nI started out from the Cycle Centre between Cinderford and Coleford where there is a well-stocked cycle shop with bikes for hire. I arrived for a summer`s evening ride just as the shop was closing but was pleased I was persuaded by the friendly old character running the shop to buy a map of the trail – he even reopened his shop for me! Although it was well marked in some sections, other parts seemed poorly signposted – if there were signs they were somewhat ambiguous. As I cycled along the wooded track I kept my eye out for the wild boar and deer which inhabit the forest. I didn`t see either but did come across several sheep which roam freely in the Forest – an ancient grazing right granted to those born there.\r\n\r\nI think it fair to say that much of the local architecture is not of great character, many of the Forest of Dean cottages were built when coal mining expanded in the area in the 19th century. However, I did come across some older buildings of interest. As with my native Yorkshire it is the impact that industry has had over the centuries on the natural environment which today creates some of the most interesting and striking landscapes in the Forest.\r\n\r\nSaying that, the highlight is a totally natural sight. In the far west of the Forest, the River Wye winds its way around a 500 foot high limestone outcrop through a deeply wooded gorge. From the top of Symonds Yat Rock the views across the Forest, down the gorge and over to the Welsh hills are breathtaking. The Rock is on the Gloucestershire side of the river, with Herefordshire on the opposite side. The only connection between the two banks is an ancient hand-pull ferry. For a small fee the ferryman pulls people across the river using an overhead rope. Far above, on the natural battlements of my fairytale castleHealth Fitness Articles, I watched birds gliding below me and squirrels scurrying along the carpet of the wood and beat my retreat. \r\n\r\n[b]by Peter Hunt (Article kindly provided by articlesfactory.com)[/b]', 'no', " . $now . ", " . $now . ", 0, 'yes', '" . $rss . "', NULL, 'slug-3', 'forest,dean,walking', 'no', '', '', 'yes'),
(4, 0, 'Making your Own Collection of Music Memorabilia', 'Music memorabilia were a little difficult to catch hold off in the earlier times. However, with the increasing demand and huge outburst in the number of music lovers; getting a music memorabilia is no more difficult. They are easily available through online auction websites as well as music e-stores.\r\n\r\nCollecting music memorabilia:\r\n\r\nCollecting music memorabilia is an art. Music memorabilia is indeed high in cost. Not all collectibles for a music memorabilia are expensive. Minor things like key rings, pictures, posters, and t-shirts can be bought for minimal rates. These items are classified more as merchandise than memorabilia. Nevertheless, they are good to start with.\r\n\r\nYou should look for a right timing to buy the same, meaning a time when stores are running sale and discount period. There are many items that can be collected for making your own music memorabilia.\r\n\r\nHow to make your own memorabilia?\r\n\r\nMemorabilia is so important that it can\'t be measured by money. Even though, if you feel that you cannot afford to have an expensive music memorabilia, you can take the following measures to make your own easy music memorabilia:\r\n\r\nFirstly, start by choosing the lyrics of the songs that impress you the most. Combine all the lyrics and songs along with the photographs of your favorite singers.\r\n\r\nYou can collage all these things together and frame it in a beautiful frame.\r\n\r\nYou can also add props and items that describe the lyrics of the song in the album. To exemplify, in a fighting song, you can add boxing gloves to make the memorabilia look more real. You can also add tickets of any live music concert that you or your friends have attended in the frame.\r\n\r\nLastly, the most happening thing that you can do for your memorabilia is to place a photograph having self signed autograph of your singer in that frame. However, it is not easy to get such an autographed photograph.\r\n\r\nAll the above tips are enough to help you make a cool and peppy memorabilia on your ownFree Web Content, at your home itself and without costing you a chunk.\r\n\r\n[b]by Michael (Article kindly provided by articlesfactory.com)[/b]', 'no', " . $now . ", " . $now . ", 0, 'yes', '" . $rss . "', NULL, 'slug-4', 'music,collection', 'yes', '', '', 'yes'),
(5, 0, 'Antique English Victorian Writing Tables Are Stylish and Functional', 'If your living room or office needs a special piece of furniture that will draw the eye and add timeless beauty to the room, you may be having trouble finding such an item at the regular stores near you. Modern furniture is often cheaply made and mass produced, so that no matter what store you are shopping at, the furniture will all look the same. Finding the right desk or writing table may be a challenging task, but if you try an English antiques dealer, you may be pleasantly surprised. A good dealer will sell antique English Victorian writing tables, as well as Georgian writing tables that are impeccably designed and eye catching in their elegance.\r\n\r\nEnglish Victorian writing tables are similar to desks of today in function, but they are far more intricate in their design. Often the feet are curved or curled to give them a more elegant look.\r\n\r\nThese writing tables have many cabinets and cupboards that are hidden by pieces that can slide away and some even had hidden backgammon tables or playing tables that could be exposed when you slid away the top of the desk. These English Victorian writing tables are similar to Georgian writing tables as well. Both of these types of desks were made using quality woods such as Walnut (which was prevalent in much of the Victorian era) and Mahogany, which was heavily utilized in Georgian era pieces. The lavish woods and advanced designs of the pieces of furniture are what makes them so special and what makes the time period that they came from so easy to determine.\r\n\r\nIf you want to add timeless pieces of furniture that were made by hand with incredible delicacy and care, look at an English antiques dealer that only sells the highest quality furniture. You will be able to find English Victorian writing tables and Georgian writing tables that do not look like ordinaryHealth Fitness Articles, modern pieces of furniture. They will add class and elegance to any room you put them in and are as functional as they are pretty to look at. You do not have to settle for the homogenized furniture that is made in factories in massive quantities so that everyone has the same pieces. You can find extraordinary and rare pieces of furniture from the Victorian and Georgian eras at English antiques dealers online.\r\n\r\n[b]by Stephanie Ellsey (Article kindly provided by articlesfactory.com)[/b]', 'no', " . $now . ", " . $now . ", 0, 'yes', '" . $rss . "', 'Maian Weblog Demo Article Five', 'slug-5', 'slug,gfgfg', 'no', '', '', 'yes')", true);
if ($query === 'err') {
  $dataE[] = DB_PREFIX . 'journals';
  $ERR     = $DB->db_error(true);
  mswInsLog(DB_PREFIX . 'journals', $ERR[1], $ERR[0], __LINE__, __FILE__, $DB, 'Insert (Demo)');
  ++$count;
  ++$dcount;
}

//=========================
// JOURNAL CATEGORIES
//=========================

$DB->db_query("TRUNCATE TABLE `" . DB_PREFIX . "cat_journal`");
$query = $DB->db_query("INSERT INTO `" . DB_PREFIX . "cat_journal` (`journal`, `category`, `private`, `hidden`) VALUES
(1, 1, 'no', 'no'),
(2, 3, 'no', 'no'),
(3, 4, 'no', 'no'),
(4, 5, 'no', 'no'),
(5, 2, 'no', 'no')", true);
if ($query === 'err') {
  $dataE[] = DB_PREFIX . 'cat_journal';
  $ERR     = $DB->db_error(true);
  mswInsLog(DB_PREFIX . 'cat_journal', $ERR[1], $ERR[0], __LINE__, __FILE__, $DB, 'Insert (Demo)');
  ++$count;
  ++$dcount;
}

//=========================
// BOXES
//=========================

$query = $DB->db_query("INSERT INTO `" . DB_PREFIX . "boxes` (`title`, `info`, `ordr`, `en`, `tmp`, `icon`) VALUES (
'Links', 'Custom boxes can be added via the control panel.\r\n\r\nFor more free software, please visit:\r\n\r\n[urlnew=https://www.maianscriptworld.co.uk]Maian Script World[/urlnew]', 3, 'yes', '', 'link'
)", true);
if ($query === 'err') {
  $dataE[] = DB_PREFIX . 'boxes';
  $ERR     = $DB->db_error(true);
  mswInsLog(DB_PREFIX . 'boxes', $ERR[1], $ERR[0], __LINE__, __FILE__, $DB, 'Insert (Demo)');
  ++$count;
  ++$dcount;
}

//=========================
// PAGES
//=========================

$DB->db_query("TRUNCATE TABLE `" . DB_PREFIX . "pages`");
$query = $DB->db_query("INSERT INTO `" . DB_PREFIX . "pages` (`name`, `metat`, `info`, `en`, `tmp`, `landing`, `slug`, `ordr`) VALUES
('Page One', '', 'Lorem ipsum dolor sit amet consectetuer quis est at felis dui. Dictum vitae sollicitudin condimentum condimentum Vivamus enim venenatis at nec consequat. Euismod Sed laoreet libero urna Aenean Pellentesque adipiscing Curabitur tortor neque. Quisque magna elit urna leo a Pellentesque accumsan mus In ut. Risus Maecenas ligula ullamcorper eros eu fringilla tellus eget condimentum.\r\n\r\n[youtube]KsJ_bzYyrHw[/youtube]\r\nLorem ipsum dolor sit amet consectetuer quis est at felis dui. Dictum vitae sollicitudin condimentum condimentum Vivamus enim venenatis at nec consequat. Euismod Sed laoreet libero urna Aenean Pellentesque adipiscing Curabitur tortor neque. Quisque magna elit urna leo a Pellentesque accumsan mus In ut. Risus Maecenas ligula ullamcorper eros eu fringilla tellus eget condimentum.\r\n\r\nLorem ipsum dolor sit amet consectetuer quis est at felis dui. Dictum vitae sollicitudin condimentum condimentum Vivamus enim venenatis at nec consequat. Euismod Sed laoreet libero urna Aenean Pellentesque adipiscing Curabitur tortor neque. Quisque magna elit urna leo a Pellentesque accumsan mus In ut. Risus Maecenas ligula ullamcorper eros eu fringilla tellus eget condimentum.', 'yes', '', 'no', 'page-one', 1),
('Page Two', '', 'Lorem ipsum dolor sit amet consectetuer quis est at felis dui. Dictum vitae sollicitudin condimentum condimentum Vivamus enim venenatis at nec consequat. Euismod Sed laoreet libero urna Aenean Pellentesque adipiscing Curabitur tortor neque. Quisque magna elit urna leo a Pellentesque accumsan mus In ut. Risus Maecenas ligula ullamcorper eros eu fringilla tellus eget condimentum.\r\n\r\n[youtube]PPmyYs92GDs[/youtube]\r\nLorem ipsum dolor sit amet consectetuer quis est at felis dui. Dictum vitae sollicitudin condimentum condimentum Vivamus enim venenatis at nec consequat. Euismod Sed laoreet libero urna Aenean Pellentesque adipiscing Curabitur tortor neque. Quisque magna elit urna leo a Pellentesque accumsan mus In ut. Risus Maecenas ligula ullamcorper eros eu fringilla tellus eget condimentum.\r\n\r\nLorem ipsum dolor sit amet consectetuer quis est at felis dui. Dictum vitae sollicitudin condimentum condimentum Vivamus enim venenatis at nec consequat. Euismod Sed laoreet libero urna Aenean Pellentesque adipiscing Curabitur tortor neque. Quisque magna elit urna leo a Pellentesque accumsan mus In ut. Risus Maecenas ligula ullamcorper eros eu fringilla tellus eget condimentum.', 'yes', '', 'no', 'page-two', 2)", true);
if ($query === 'err') {
  $dataE[] = DB_PREFIX . 'pages';
  $ERR     = $DB->db_error(true);
  mswInsLog(DB_PREFIX . 'pages', $ERR[1], $ERR[0], __LINE__, __FILE__, $DB, 'Insert (Demo)');
  ++$count;
  ++$dcount;
}

?>
