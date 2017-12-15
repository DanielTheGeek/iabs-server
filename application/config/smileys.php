<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| SMILEYS
| -------------------------------------------------------------------
| This file contains an array of smileys for use with the smiley helper.
| Individual images can be used to replace multiple smileys.  For example:
| :-) and :) use the same image replacement.
|
| Please see user guide for more info:
| https://codeigniter.com/user_guide/helpers/smiley_helper.html
|
*/
$smileys = array(

//	smiley			image name						width	height	alt

	':+1:'			=>	array('+1.png',				'19',	'19',	'+1'),
	':-1:'			=>	array('-1.png',				'19',	'19',	'-1'),
	':8ball:'		=>	array('8ball.png',			'19',	'19',	'8 ball'),
	':100:'			=>	array('100.png',			'19',	'19',	'100'),
	':109:'			=>	array('109.png',			'19',	'19',	'109'),
	':1234:'		=>	array('1234.png',			'19',	'19',	'1234'),
	':a:'			=>	array('a.png',				'19',	'19',	'a'),
	':ab:'			=>	array('ab.png',				'19',	'19',	'ab'),
	':abc:'			=>	array('abc.png',			'19',	'19',	'abc'),
	':abcd:'		=>	array('abcd.png',			'19',	'19',	'abcd'),
	':accept:'		=>	array('accept.png',			'19',	'19',	'accept'),
	':aerial_tramway:'	=>	array('aerial_tramway.png',	'19',	'19',	'aerial tramway'),
	':airplane:'	=>	array('airplane.png',	'19',	'19',	'airplane'),
	':alarm_clock:'	=>	array('alarm_clock.png',	'19',	'19',	'alarm clock'),
	':alien:'		=>	array('alien.png',	'19',	'19',	'tongue wink'),
	':ambulance:'	=>	array('ambulance.png',		'19',	'19',	'ambulance'),
	':anchor:'		=>	array('anchor.png',			'19',	'19',	'anchor'),
	':angel:'		=>	array('angel.png',			'19',	'19',	'angel'),
	':anger:'		=>	array('anger.png',			'19',	'19',	'anger'),
	':angry:'		=>	array('angry.png',			'19',	'19',	'angry'),
	':anguished:'	=>	array('anguished.png',		'19',	'19',	'anguished'),
	':ant:'			=>	array('ant.png',			'19',	'19',	'ant'),
	':apple:'		=>	array('apple.png',			'19',	'19',	'apple'),
	':aquarius:'	=>	array('aquarius.png',		'19',	'19',	'aquarius'),
	':aries:'		=>	array('aries.png',			'19',	'19',	'aries'),
	':arrow_backward:'		=>	array('arrow_backward.png',	'19',	'19',	'arrow backward'),
	':arrow_double_down:'	=>	array('arrow_double_down.png','19',	'19',	'arrow double down'),
	'arrow_double_up'			=>	array('arrow_double_up.png','19',	'19',	'arrow double up'),
	':arrow_down:'			=>	array('arrow_down.png',	'19',	'19',	'arrow down'),
	':arrow_down_small:'	=>	array('arrow_down_small.png',	'19',	'19',	'arrow down small'),
	':arrow_forward:'		=>	array('arrow_forward.png',	'19',	'19',	'arrow forward'),
	':arrow_heading_down:'	=>	array('arrow_heading_down.png',	'19',	'19',	'arrow heading down'),
	':arrow_heading_up:'	=>	array('arrow_heading_up.png',	'19',	'19',	'arrow heading up'),
	':arrow_left:'	=>	array('arrow_left.png',		'19',	'19',	'arrow left'),
	':arrow_lower_left:' =>	array('arrow_lower_left.png',	'19',	'19',	'arrow lower left'),
	':arrow_lower_right:'	=>	array('arrow_lower_right.png',	'19',	'19',	'arrow lower right'),
	':arrow_right:'	=>	array('arrow_right.png',	'19',	'19',	'arrow right'),
	':arrow_right_hook:' =>	array('arrow_right_hook.png', '19',	'19',	'arrow right hook'),
	':arrow_up:'	=>	array('arrow_up.png',		'19',	'19',	'arrow up'),
	':arrow_up_down:' => array('arrow_up_down.png',	'19',	'19',	'arrow up down'),
	':arrow_up_small:' => array('arrow_up_small.png', '19',	'19',	'arrow up small'),
	':arrow_upper_left:' =>	array('arrow_upper_left.png', '19',	'19', 'arrow upper left'),
	':arrow_upper_right:' => array('arrow_upper_right.png', '19',	'19',	'arrow upper right'),
	':arrows_clockwise:' =>	array('arrows_clockwise.png',	'19',	'19',	'arrows clockwise'),
	':arrows_counterclockwise:' =>	array('arrows_counterclockwise.png',	'19',	'19',	'arrows counterclockwise'),
	':art:'					=>	array('art.png',	'19',	'19',	'art'),
	':articulated_lorry:' 	=>	array('articulated_lorry.png',	'19',	'19',	'articulated_lorry'),
	':astonished:' 			=>	array('astonished.png',	'19',	'19',	'astonished'),
	':atm:' 				=>	array('atm.png',	'19',	'19',	'atm'),
	':b:' 					=>	array('b.png',		'19',	'19',	'b'),
	':baby:' 				=>	array('baby.png',	'19',	'19',	'baby'),
	':baby_bottle:' =>	array('baby_bottle.png',	'19',	'19',	'baby bottle'),
	':baby_chick:' 	=>	array('baby_chick.png',		'19',	'19',	'baby chick'),
	':baby_symbol:' =>	array('baby_symbol.png',	'19',	'19',	'baby symbol'),
	':baggage_claim:' => array('baggage_claim.png',	'19',	'19',	'baggage claim'),
	':balloon:' 			=>	array('balloon.png','19',	'19',	'balloon'),
	':bamboo:' 				=>	array('bamboo.png',	'19',	'19',	'bamboo'),
	':banana:' 				=>	array('banana.png',	'19',	'19',	'banana'),
	':bangbang:' 			=>	array('bangbang.png','19',	'19',	'bangbang'),
	':bank:' 				=>	array('bank.png',	'19',	'19',	'bank'),
	':bar_chart:' 			=>	array('bar_chart.png','19',	'19',	'bar chart'),
	':barber:' 				=>	array('barber.png',	'19',	'19',	'barber'),
	':baseball:' 			=>	array('baseball.png','19',	'19',	'baseball'),
	':basketball:' 			=>	array('basketball.png',	'19',	'19',	'basketball'),
	':bath:' 				=>	array('bath.png',	'19',	'19',	'bath'),
	':bathtub:' 			=>	array('bathtub.png','19',	'19',	'bathtub'),
	':battery:' 			=>	array('battery.png','19',	'19',	'battery'),
	':beer:' 				=>	array('beer.png',	'19',	'19',	'beer'),
	':beers:' 				=>	array('beers.png',	'19',	'19',	'beers'),
	':beetle:' 				=>	array('beetle.png',	'19',	'19',	'beetle'),
	':beginner:' 			=>	array('beginner.png','19',	'19',	'beginner'),
	':bell:' 				=>	array('bell.png',	'19',	'19',	'bell'),
	':bento:' 				=>	array('bento.png',	'19',	'19',	'bento'),
	':bicyclist:' 			=>	array('bicyclist.png',	'19',	'19',	'bicyclist'),
	':bike:' 				=>	array('bike.png',	'19',	'19',	'bike'),
	':bikini:' 				=>	array('bikini.png',	'19',	'19',	'bikini'),
	':bird:' 				=>	array('bird.png',	'19',	'19',	'bird'),
	':birthday:' 			=>	array('birthday.png','19',	'19',	'birthday'),
	':black_circle:' 		=>	array('black_circle.png','19',	'19',	'black circle'),
	':black_joker:' 		=>	array('black_joker.png','19',	'19',	'black joker'),
	':black_nib:' 			=>	array('black_nib.png','19',	'19',	'black nib'),
	':black_square:' 		=>	array('black_square.png','19',	'19',	'black square'),
	':black_square_button:' =>	array('black_square_button.png','19',	'19',	'black square button'),
	':blossom:' 			=>	array('blossom.png','19',	'19',	'blossom'),
	':blowfish:' 			=>	array('blowfish.png','19',	'19',	'blowfish'),
	':blue_book:' 			=>	array('blue_book.png','19',	'19',	'blue book'),
	':blue_car:' 			=>	array('blue_car.png', '19',	'19',	'blue car'),
	':blue_heart:' 			=>	array('blue_heart.png',	'19',	'19',	'blue_heart'),
	':blush:' 				=>	array('blush.png',		'19',	'19',	'blush'),
	':boar:' 				=>	array('boar.png',		'19',	'19',	'boar'),
	':boat:' 				=>	array('boat.png',		'19',	'19',	'boat'),
	':bomb:' 				=>	array('bomb.png',		'19',	'19',	'bomb'),
	':book:' 				=>	array('book.png',		'19',	'19',	'book'),
	':bookmark:' 			=>	array('bookmark.png',	'19',	'19',	'bookmark'),
	':bookmark_tabs:' 		=>	array('bookmark_tabs.png','19',	'19',	'bookmark_tabs'),
	':books:' 				=>	array('books.png',		'19',	'19',	'books'),
	':boom:' 				=>	array('boom.png',		'19',	'19',	'boom'),
	':boot:' 				=>	array('boot.png',		'19',	'19',	'boot'),
	':bouquet:' 			=>	array('bouquet.png',	'19',	'19',	'bouquet'),
	':bow:' 				=>	array('bow.png',		'19',	'19',	'bow'),
	':bowling:' 			=>	array('bowling.png',	'19',	'19',	'bowling'),
	':bowtie:' 				=>	array('bowtie.png',		'19',	'19',	'bowtie'),
	':boy:' 				=>	array('boy.png',		'19',	'19',	'boy'),
	':bread:' 				=>	array('bread.png',		'19',	'19',	'bread'),
	':bride_with_veil:' 	=>	array('bride_with_veil.png','19',	'19',	'bride with veil'),
	':bridge_at_night:' 	=>	array('bridge_at_night.png','19',	'19',	'bridge at night'),
	':briefcase:' 			=>	array('briefcase.png',	'19',	'19',	'briefcase'),
	':broken_heart:' 		=>	array('broken_heart.png','19',	'19',	'broken heart'),
	':bug:' 				=>	array('bug.png',		'19',	'19',	'bug'),
	':bulb:' 				=>	array('bulb.png',		'19',	'19',	'bulb'),
	':bullettrain_front:' 	=>	array('bullettrain_front.png',	'19',	'19',	'bullettrain front'),
	':bullettrain_side:' 	=>	array('bullettrain_side.png',	'19',	'19',	'bullettrain side'),
	':bus:' 				=>	array('bus.png',		'19',	'19',	'bus'),
	':busstop:' 			=>	array('busstop.png',	'19',	'19',	'busstop'),
	':bust_in_silhouette:' 	=>	array('bust_in_silhouette.png',	'19',	'19',	'bust in silhouette'),
	':busts_in_silhouette:' =>	array('busts_in_silhouette.png','19',	'19',	'busts in silhouette'),
	':cactus:' 				=>	array('cactus.png',		'19',	'19',	'cactus'),
	':cake:' 				=>	array('cake.png',		'19',	'19',	'cake'),
	':calendar:' 			=>	array('calendar.png',	'19',	'19',	'calendar'),
	':calling:' 			=>	array('calling.png',	'19',	'19',	'calling'),
	':camel:' 				=>	array('camel.png',		'19',	'19',	'camel'),
	':camera:' 				=>	array('camera.png',		'19',	'19',	'camera'),
	':cancer:' 				=>	array('cancer.png',		'19',	'19',	'cancer'),
	':candy:' 				=>	array('candy.png',		'19',	'19',	'candy'),
	':capital_abcd:' 		=>	array('capital_abcd.png','19',	'19',	'ABCD'),
	':capricorn:' 			=>	array('capricorn.png',	'19',	'19',	'capricorn'),
	':car:' 				=>	array('car.png',		'19',	'19',	'car'),
	':card_index:' 			=>	array('card_index.png',	'19',	'19',	'card_index'),
	':carousel_horse:' 		=>	array('carousel_horse.png','19',	'19',	'carousel horse'),
	':cat:' 				=>	array('cat.png',		'19',	'19',	'cat'),
	':cat2:' 				=>	array('cat2.png',		'19',	'19',	'walking cat'),
	':cd:' 					=>	array('cd.png',			'19',	'19',	'cd'),
	':chart:' 				=>	array('chart.png',		'19',	'19',	'chart'),
	':chart_with_downwards_trend:' 	=>	array('chart_with_downwards_trend.png',	'19',	'19',	'chart with downwards trend'),
	':chart_with_upwards_trend:' =>	array('chart_with_upwards_trend.png','19',	'19',	'chart with upwards trend'),
	':checked_box:' 		=>	array('checked_box.png','19',	'19',	'checked box'),
	':checkered_flag:' 		=>	array('checkered_flag.png','19','19',	'checkered flag'),
	':cherries:' 			=>	array('cherries.png',	'19',	'19',	'cherries'),
	':cherry_blossom:' 		=>	array('cherry_blossom.png',	'19',	'19',	'cherry blossom'),
	':chestnut:' 			=>	array('chestnut.png',	'19',	'19',	'chestnut'),
	':chicken:'				=>	array('chicken.png',	'19',	'19',	'chicken'),
	':children_crossing:' 	=>	array('children_crossing.png',	'19',	'19',	'children crossing'),
	':chocolate_bar:' 		=>	array('chocolate_bar.png','19',	'19',	'chocolate bar'),
	':christmas_tree:' 		=>	array('christmas_tree.png',	'19',	'19',	'christmas tree'),
	':church:' 				=>	array('church.png',		'19',	'19',	'church'),
	':cinema:' 				=>	array('cinema.png',		'19',	'19',	'cinema'),
	':circus_tent:' 		=>	array('circus_tent.png','19',	'19',	'circus tent'),
	':city_sunrise:' 		=>	array('city_sunrise.png','19',	'19',	'city sunrise'),
	':city_sunset:' 		=>	array('city_sunset.png','19',	'19',	'city sunset'),
	':cl:' 					=>	array('cl.png',			'19',	'19',	'cl'),
	':clap:' 				=>	array('clap.png',		'19',	'19',	'clap'),
	':clapper:'		 		=>	array('clapper.png',	'19',	'19',	'clapper'),
	':clipboard:' 			=>	array('clipboard.png',	'19',	'19',	'clipboard'),
	':clock1:'				=>	array('clock1.png',		'19',	'19',	'1:00'),
	':clock2:'				=>	array('clock2.png',		'19',	'19',	'2:00'),
	':clock3:'				=>	array('clock3.png',		'19',	'19',	'3:00'),
	':clock4:'				=>	array('clock4.png',		'19',	'19',	'4:00'),
	':clock5:'				=>	array('clock5.png',		'19',	'19',	'5:00'),
	':clock6:'				=>	array('clock6.png',		'19',	'19',	'6:00'),
	':clock7:'				=>	array('clock7.png',		'19',	'19',	'7:00'),
	':clock8:'				=>	array('clock8.png',		'19',	'19',	'8:00'),
	':clock9:'				=>	array('clock9.png',		'19',	'19',	'9:00'),
	':clock10:'				=>	array('clock10.png',	'19',	'19',	'10:00'),
	':clock11:'				=>	array('clock11.png',	'19',	'19',	'11:00'),
	':clock12:'				=>	array('clock12.png',	'19',	'19',	'12:00'),
	':clock130:'			=>	array('clock130.png',	'19',	'19',	'1:30'),
	':clock230:'			=>	array('clock230.png',	'19',	'19',	'2:30'),
	':clock330:'			=>	array('clock330.png',	'19',	'19',	'3:30'),
	':clock430:'			=>	array('clock430.png',	'19',	'19',	'4:30'),
	':clock530:'			=>	array('clock530.png',	'19',	'19',	'5:30'),
	':clock630:'			=>	array('clock630.png',	'19',	'19',	'6:30'),
	':clock730:'			=>	array('clock730.png',	'19',	'19',	'7:30'),
	':clock830:'			=>	array('clock830.png',	'19',	'19',	'8:30'),
	':clock930:'			=>	array('clock930.png',	'19',	'19',	'9:30'),
	':clock1030:'			=>	array('clock1030.png',	'19',	'19',	'10:30'),
	':clock1130:'			=>	array('clock1130.png',	'19',	'19',	'11:30'),
	':clock1230:'			=>	array('clock1230.png',	'19',	'19',	'12:30'),
	':closed_book:'			=>	array('closed_book.png','19',	'19',	'closed book'),
	':closed_lock_with_key:'=>	array('closed_lock_with_key.png','19',	'19',	'closed lock with key'),
	':closed_umbrella:'		=>	array('closed_umbrella.png','19',	'19',	'closed umbrella'),
	':cloud:'				=>	array('cloud.png',		'19',	'19',	'cloud')
);
