// Group 2 Entertainment site
//
// vers. 0.1 - 20081118.0515
//
// http://uol-site.datanet-pt.net/@js/event_handlers.js


      //////////////////////////
      // Variable declaration //
      //////////////////////////



      ////////////////////
      // Initialization //
      ////////////////////



      //////////////////////////
      // Functions definition //
      //////////////////////////

      // Define the 'RegisterEventHandlers()' function

        function RegisterEventHandlers()
        {
          document.getElementById("EmailForm").onsubmit = function ()
          {
            return confirm("Are you sure you want to submit the email?");
          }

          document.getElementById("EmailForm").onreset = function ()
          {
            return confirm("You are going to reset the input email address.");
          }
        } ;



      ///////////////////////////
      // Give greating message //
      ///////////////////////////



      /////////////////////////////////////////////////
      // Output the result XHTML page to the browser //
      /////////////////////////////////////////////////


