// Morais & Almeida WEB site
//
// vers. 0.1.001 - 20121208.1808
//
// http://morais-e-almeida.datanet-pt.net/@js/ajax.js


      //////////////////////////
      // Variable declaration //
      //////////////////////////

        var XMLHttpRequestObject = false ;


      ////////////////////
      // Initialization //
      ////////////////////

      // Initialize the XMLHttpRequest

        if (window.XMLHttpRequest)
        {
          XMLHttpRequestObject = new XMLHttpRequest() ;
        } else if (window.ActiveXObject)
        {
          XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP") ;
        }



      //////////////////////////
      // Functions definition //
      //////////////////////////

        /////////////////////////////////////////////////////
        // Define the 'GetData(DataSource,DivID)' function //
        // ----------------------------------------------- //
        // (for asyncronous server data request for a      //
        // <DIV></DIV> section)                            //
        /////////////////////////////////////////////////////

        function GetData(DataSource,DivID)
        {
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



      /////////////////////////////////////////////////////////////
      // Define the 'GetDataMultiple(DataSource,DivID)' function //
      // ------------------------------------------------------- //
      // (for asyncronous server data request for a <DIV></DIV>  //
      // section and capable of handeling multiple concurrent    //
      // XMLHttpRequestObject instances                          //
      /////////////////////////////////////////////////////////////

        function GetDataMultiple(DataSource,DivID)
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



        ////////////////////////////////////////////////
        // Define the 'CreateAjaxContext()' function  //
        // ------------------------------------------ //
        // Create and return an XMLHttpRequestObject, //
        // if possibe, or return FALSE otherwise      //
        ////////////////////////////////////////////////

        function CreateAjaxContext()
        {
	  try
	  {
            if( window.XMLHttpRequest )
            {
              return new XMLHttpRequest();
            }
            else  if( window.ActiveXObject )
            {
              return new ActiveXObject( "Microsoft.XMLHTTP" );
            }
          }
	  catch (e)
	  {
            return false;
	  }
        }



        //////////////////////////////////////////////////////////
        // Define the 'SyncExchangeData(url,data)' function     //
        // ---------------------------------------------------- //
        // If data is NULL, GET the URL resource                //
        // If data is not NULL, POST data onto the URL resource //
        //                                                      //
        // The data is exchanged syncrounously                  //
        //////////////////////////////////////////////////////////

        function SyncExchangeData(url, data)
        {
          var req_obj = CreateAjaxContext();

          if( data != null )
          {
            req_obj.open( "POST", url, false );
            req_obj.setRequestHeader( "Content-type", "application/x-www-form-urlencoded" );
            req_obj.setRequestHeader( "Content-length", data.length );
          }
	  else
          {
            req_obj.open( "GET", url, false );
	  }
          req_obj.send( data );

          return req_obj;
        }



        ///////////////////////////////////////////////////////////////////
        // Define the 'AsyncExchangeData(url,data,callback)' function    //
        // ------------------------------------------------------------- //
        // If data is NULL, GET the URL resource                         //
        // If data is not NULL, POST data onto the URL resource          //
        //                                                               //
        // The data is exchanged asyncronously, calling the provided     //
        // callback function whenever data transfer is complete          //
        ///////////////////////////////////////////////////////////////////


        function AsyncExchangeData(url, data, callback)
        {
	  var req_obj = CreateAjaxContext();

	  if( data != null )
          {
            req_obj.open( "POST", url, true );
            req_obj.setRequestHeader( "Content-type", "application/x-www-form-urlencoded" );
            req_obj.setRequestHeader( "Content-length", data.length );
	  }
	  else
          {
            req.open( "GET", url, true );
	  }
	  req_obj.onreadystatechange = function()
                                       {
                                         if(req_obj.readyState == 4) callback.complete( req_obj );
                                       }
	  req_obj.send( data );

	  return req_obj;

        }

