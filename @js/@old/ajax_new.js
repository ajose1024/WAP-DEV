// Group 2 Entertainment site
//
// vers. 0.1 - 20081118.0514
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

      // Define the 'GetData(DataSource,DivID)' function (for asyncronous server data request)

        function GetData(DataSource,DivID)
        {

          var XMLHttpRequestObject = false ;

        // Initialize the XMLHttpRequest

          if (window.XMLHttpRequest)
          {
            XMLHttpRequestObject = new XMLHttpRequest() ;
//            XMLHttpRequestObject.overrideMimeType("text/xml);
          } else if (window.ActiveXObject)
          {
            XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP") ;
          }


          if (XMLHttpRequestObject)
          {
            var obj = document.getElementById(DivID) ;
            XMLHttpRequestObject.open("GET", DataSource) ;

            XMLHttpRequestObject.onreadystatechange = function ()
            {
              if (XMLHttpRequestObject.readyState == 4   &&
                  XMLHttpRequestObject.status     == 200 )
              {
                obj.innerHTML = XMLHttpRequestObject.responseText ;
              }
            }
            XMLHttpRequestObject.send(null) ;
          }
        }



      ///////////////////////////
      // Give greating message //
      ///////////////////////////



      /////////////////////////////////////////////////
      // Output the result XHTML page to the browser //
      /////////////////////////////////////////////////


