
$(document).ready(function() {
  var $searchicon = $('#searchicon i');
  var $searchbar  = $('#searchbar');
  
  $('#navigationbar ul li').on('click', function(e){ 
    if($(this).attr('id') == 'searchicon') {
      if(!$searchbar.is(":visible")) { 
        // if invisible we switch the icon to appear collapsable
        $searchicon.removeClass('fa-search').addClass('fa-search-minus');
      } 
        else {
        // if visible we switch the icon to appear as a toggle
        $searchicon.removeClass('fa-search-minus').addClass('fa-search');
      }
      
      $searchbar.slideToggle(300, function(){
        // callback after search bar animation
      });
    }
  });
  
  $('#searchform').submit(function(e){
    e.preventDefault(); // stop form submission
  });
});
