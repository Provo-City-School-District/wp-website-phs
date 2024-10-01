/*
=============================================================================================================
Directory Live Page Search
=============================================================================================================
*/
// jQuery(document).ready(function () {
//   jQuery("#filter").keyup(function () {
//     // Retrieve the input field text and reset the count to zero
//     var filter = jQuery(this).val(),
//       count = 0;

//     // Loop through the post list
//     jQuery(".staff-member-listing .post").each(function () {
//       // If the list item does not contain the text phrase fade it out
//       if (jQuery(this).text().search(new RegExp(filter, "i")) < 0) {
//         //jQuery(this).addClass('hide');
//         jQuery(this).fadeOut();

//         // Show the list item if the phrase matches and increase the count by 1
//       } else {
//         jQuery(this).show();
//         count++;
//       }
//     });
//   });
// });
jQuery(document).ready(function () {
  jQuery("#sidebar-filter").keyup(function () {
    // Retrieve the input field text and reset the count to zero
    var filter = jQuery(this).val(),
      count = 0;

    // Loop through the post list
    jQuery(".staff-member-listing .post").each(function () {
      // If the list item does not contain the text phrase fade it out
      if (jQuery(this).text().search(new RegExp(filter, "i")) < 0) {
        //jQuery(this).addClass('hide');
        jQuery(this).fadeOut();

        // Show the list item if the phrase matches and increase the count by 1
      } else {
        jQuery(this).show();
        count++;
      }
    });
    // Loop through the filterable elements
    jQuery(".filterable").each(function () {
      // If the element does not contain the text phrase, fade it out
      if (jQuery(this).text().search(new RegExp(filter, "i")) < 0) {
        jQuery(this).fadeOut();
      } else {
        jQuery(this).show();
        count++;
      }
    });
  });
});
