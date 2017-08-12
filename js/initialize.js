$(document).ready(function() {
  $('select').material_select();
});

$('.datepicker').pickadate({
   selectMonths: false, // Creates a dropdown to control month
   selectYears: false, // Creates a dropdown of 15 years to control year
   format: 'yyyy-mm-dd',
   formatSubmit: 'yyyy-mm-dd',
   min: '$.NOW()'
 });

 $('.datepicker2').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: true, // Creates a dropdown of 15 years to control year
    format: 'yyyy-mm-dd',
    formatSubmit: 'yyyy-mm-dd'
  });

 $('.button-collapse').sideNav({
      menuWidth: 300, // Default is 300
      edge: 'right', // Choose the horizontal origin
      closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
      draggable: true // Choose whether you can drag to open on touch screens
    }
  );

  function myFunction() {
      window.print();
  }

  $('.dropdown-button').dropdown({
       inDuration: 300,
       outDuration: 225,
       constrainWidth: false, // Does not change width of dropdown to that of the activator
       hover: true, // Activate on hover
       gutter: 0, // Spacing from edge
       belowOrigin: true, // Displays dropdown below the button
       alignment: 'left', // Displays dropdown with edge aligned to the left of button
       stopPropagation: false // Stops event propagation
     }
   );
   $(document).ready(function(){
   // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
   $('.modal').modal();
 });
     
   $(document).ready(function(){
       // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
       $('.modal').modal();
     });
