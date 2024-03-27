jQuery(function() {
  //Insert generated text in textbox and sample result
  jQuery(".random_class").click(function() {
    jQuery(".generate_result").val(makeid);

    //automatic update of class name
    var classSample = jQuery(".generate_result").val();
    jQuery('.class_value').text(classSample);
  });

//Automatic update of data
  jQuery('.generate_result').keyup(function() {
    var classSample = jQuery(this).val();
    jQuery('.class_value').text(classSample);
  });

  //Real time update of data in pixels
  jQuery('.font-px').keyup(function() {
    var pixelId = jQuery(this).attr("id");
    var pixelValueId = jQuery(this).attr("data-pixel-id");

    var pixelDataId = jQuery(this).attr("data-id");
    const pixelSizes = jQuery(this).val();

    //Increment of string value
    for (var i = 1; i <= 1; i++) {
        pixelIds = pixelId.replace(/(\d+)$/, function (match, n) {
            return ++n; // parse to int and increment number
        }); // replace using pattern
    }

    //Realtime update of Next field max value
    const pixelNextValue = jQuery('#'+pixelIds).val();
    if (pixelSizes < pixelNextValue ) {
      jQuery("#"+pixelId).attr({
        min: 0,
        max: pixelSizes
      });
    }

    //Realtime update of max value
    if (pixelNextValue) {
      const pixelMainValue = jQuery('#'+pixelId).val();
      jQuery("#"+pixelIds).attr({
        min: 0,
        max: pixelMainValue
      });
    }

    //Realtime update of max value from previous textfield
    const pixelValue = jQuery('#'+pixelValueId).val();
    const pixelValues = pixelValue - 1;
    jQuery("#"+pixelId).attr({
      min: 0,
      max: pixelValues
    });

    //Realtime disable update when pixels is less than 20px
    var rangeRestriction;
    if (pixelSizes <= 20) {
      rangeRestriction = true;
    } else {
      rangeRestriction = false;
    }
    jQuery("." + pixelDataId).prop({
      min: 0,
      max: 1,
      step: 0.1,
      disabled: rangeRestriction
    });
  });


//Input range value
  jQuery('.slider').on('input change', function() {
    var sliderIds = jQuery(this).attr("id");
    jQuery(this).next(jQuery('#' + sliderIds)).html(this.value);
  });
  //Display the slider value
  jQuery('.font_range_label').each(function() {
    var value = jQuery(this).prev().attr('value');
    jQuery(this).html(value);
  });
});
