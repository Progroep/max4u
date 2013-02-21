  /* Detect Mac/PC - Being used as subpixel-antialiased rendering
on Mac Webkit.
-------------------------------------------------------------- */
if (navigator.userAgent.indexOf('Mac OS X') != -1) {
  document.body.className += " mac";
} else {
  document.body.className += " pc";
}


/* Orientation Scale Bug Fix for iOS
from: http://adactio.com/journal/4470/
-------------------------------------------------------------- */
if (navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i)) {
    var viewportmeta = document.querySelector('meta[name="viewport"]');
    if (viewportmeta) {
        viewportmeta.content = 'width=device-width, minimum-scale=1.0, maximum-scale=1.0';
        document.body.addEventListener('gesturestart', function () {
            viewportmeta.content = 'width=device-width, minimum-scale=0.25, maximum-scale=1.6';
        }, false);
    }
}


// Smooth scrolling anchor links 
$('.smooth-scroll').on('click', function(e) {
   e.preventDefault();
   $('html, body').animate({ scrollTop: $(this.hash).offset().top }, 300);

   // edit: Opera requires the "html" elm. animated
});

jQuery(document).ready(function ($) {
    if ( screen.availWidth > 780 ) {
        //initialise Stellar.js
        $(window).stellar({
          hideDistantElements: false,
          horizontalScrolling: false
        });
    };
    //Cache some variables
    var links = $('.navigation').find('li');
    slide = $('.slide');
    button = $('.button');
    mywindow = $(window);
    htmlbody = $('html,body');
    //Setup waypoints plugin
    slide.waypoint(function (event, direction) {
        //cache the variable of the data-slide attribute associated with each slide
        dataslide = $(this).attr('data-slide');
        //If the user scrolls up change the navigation link that has the same data-slide attribute as the slide to active and
        //remove the active class from the previous navigation link
        if (direction === 'down') {
            $('.navigation li[data-slide="' + dataslide + '"]').addClass('active').prev().removeClass('active');
        }
        // else If the user scrolls down change the navigation link that has the same data-slide attribute as the slide to active and
        //remove the active class from the next navigation link
        else {
            $('.navigation li[data-slide="' + dataslide + '"]').addClass('active').next().removeClass('active');
        }
    });
    //waypoints doesnt detect the first slide when user scrolls back up to the top so we add this little bit of code, that removes the class
    //from navigation link slide 2 and adds it to navigation link slide 1.
    mywindow.scroll(function () {
        if (mywindow.scrollTop() == 0) {
            $('.navigation li[data-slide="1"]').addClass('active');
            $('.navigation li[data-slide="2"]').removeClass('active');
        }
    });
    //Create a function that will be passed a slide number and then will scroll to that slide using jquerys animate. The Jquery
    //easing plugin is also used, so we passed in the easing method of 'easeInOutQuint' which is available throught the plugin.
    function goToByScroll(dataslide) {
        htmlbody.animate({
            scrollTop: $('.slide[data-slide="' + dataslide + '"]').offset().top
        }, 2000, 'easeInOutQuint');
    }
    //When the user clicks on the navigation links, get the data-slide attribute value of the link and pass that variable to the goToByScroll function
    links.click(function (e) {
        e.preventDefault();
        dataslide = $(this).attr('data-slide');
        goToByScroll(dataslide);
    });
    //When the user clicks on the button, get the get the data-slide attribute value of the button and pass that variable to the goToByScroll function
    button.click(function (e) {
        e.preventDefault();
        dataslide = $(this).attr('data-slide');
        goToByScroll(dataslide);
    });


/* Waypoint css animations triggers
-------------------------------------------------------------- */

    //Slide3
    $("#slide2").waypoint(function(event, direction) {
       if (direction === 'down') {
           $(".delay").addClass("visible");
          }
          else{
            $(".delay").removeClass("visible");
          }
    }, {
       offset: 300  
    });

    //Slide 4
    $('#slide4').waypoint(function(event, direction) {
       if (direction === 'down') {
           $("i, h4").addClass("visible");
          }
          else{
            $("i, h4").removeClass("visible");
          }
    }, {
       offset: 300  
    });

});


  
/* CONTACT FORM 
***************************************************************************************************/

$(function(){

  //set global variables and cache DOM elements for reuse later
  var form = $('#contact-form').find('form'),
    formElements = form.find('input[type!="submit"],textarea'),
    formSubmitButton = form.find('[type="submit"]'),
    errorNotice = $('#errors'),
    successNotice = $('#success'),
    loading = $('#loading'),
    errorMessages = {
      required: ' is a required field',
      email: 'You have not entered a valid email address for the field: ',
      minlength: ' must be greater than '
    }
  
  //feature detection + polyfills
  formElements.each(function(){

    //if HTML5 input placeholder attribute is not supported
    if(!Modernizr.input.placeholder){
      var placeholderText = this.getAttribute('placeholder');
      if(placeholderText){
        $(this)
          .addClass('placeholder-text')
          .val(placeholderText)
          .bind('focus',function(){
            if(this.value == placeholderText){
              $(this)
                .val('')
                .removeClass('placeholder-text');
            }
          })
          .bind('blur',function(){
            if(this.value == ''){
              $(this)
                .val(placeholderText)
                .addClass('placeholder-text');
            }
          });
      }
    }
    
    //if HTML5 input autofocus attribute is not supported
    if(!Modernizr.input.autofocus){
      if(this.getAttribute('autofocus')) this.focus();
    }
    
  });
  
  //to ensure compatibility with HTML5 forms, we have to validate the form on submit button click event rather than form submit event. 
  //An invalid html5 form element will not trigger a form submit.
  formSubmitButton.bind('click',function(){
    var formok = true,
      errors = [];
      
    formElements.each(function(){
      var name = this.name,
        nameUC = name.ucfirst(),
        value = this.value,
        placeholderText = this.getAttribute('placeholder'),
        type = this.getAttribute('type'), //get type old school way
        isRequired = this.getAttribute('required'),
        minLength = this.getAttribute('data-minlength');
      
      //if HTML5 formfields are supported     
      if( (this.validity) && !this.validity.valid ){
        formok = false;
        
        console.log(this.validity);
        
        //if there is a value missing
        if(this.validity.valueMissing){
          errors.push(nameUC + errorMessages.required); 
        }
        //if this is an email input and it is not valid
        else if(this.validity.typeMismatch && type == 'email'){
          errors.push(errorMessages.email + nameUC);
        }
        
        this.focus(); //safari does not focus element an invalid element
        return false;
      }
      
      //if this is a required element
      if(isRequired){ 
        //if HTML5 input required attribute is not supported
        if(!Modernizr.input.required){
          if(value == placeholderText){
            this.focus();
            formok = false;
            errors.push(nameUC + errorMessages.required);
            return false;
          }
        }
      }

      //if HTML5 input email input is not supported
      if(type == 'email'){  
        if(!Modernizr.inputtypes.email){ 
          var emailRegEx = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/; 
          if( !emailRegEx.test(value) ){  
            this.focus();
            formok = false;
            errors.push(errorMessages.email + nameUC);
            return false;
          }
        }
      }
      
      //check minimum lengths
      if(minLength){
        if( value.length < parseInt(minLength) ){
          this.focus();
          formok = false;
          errors.push(nameUC + errorMessages.minlength + minLength + ' charcters');
          return false;
        }
      }
    });
    
    //if form is not valid
    if(!formok){
      
      //animate required field notice
      $('#req-field-desc')
        .stop()
        .animate({
          marginLeft: '+=' + 5
        },150,function(){
          $(this).animate({
            marginLeft: '-=' + 5
          },150);
        });
      
      //show error message 
      showNotice('error',errors);
      
    }
    //if form is valid
    else {
      loading.show();
      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: form.serialize(),
        success: function(){
          showNotice('success');
          form.get(0).reset();
          loading.hide();
        }
      });
    }
    
    return false; //this stops submission off the form and also stops browsers showing default error messages
    
  });

  //other misc functions
  function showNotice(type,data)
  {
    if(type == 'error'){
      successNotice.hide();
      errorNotice.find("li[id!='info']").remove();
      for(x in data){
        errorNotice.append('<li>'+data[x]+'</li>'); 
      }
      errorNotice.show();
    }
    else {
      errorNotice.hide();
      successNotice.show(); 
    }
  }
  
  String.prototype.ucfirst = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
  }
  
});


/* End CONTACT FORM 
***************************************************************************************************/







