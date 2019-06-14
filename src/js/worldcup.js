function GetGroupResults(max_cnt){
	$.when(  $.get( 'https://worldcup.sfg.io/teams/group_results' ) )
	.then(function( result ) {
        console.log(result);
        }
    ); 
} 