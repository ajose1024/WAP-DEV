// Group 2 Entertainment site
//
// vers. 0.1 - 20081118.0517
//
// http://uol-site.datanet-pt.net/@js/event_handlers.js


      //////////////////////////
      // Variable declaration //
      //////////////////////////

        var HelpTimer ;
        var HelpTimeout ;


      ////////////////////
      // Initialization //
      ////////////////////

        HelpTimer = 0 ;
        HelpTimeout = 3000 ;


      //////////////////////////
      // Functions definition //
      //////////////////////////

      // Define the 'HelpMsg(SectID,MessageNum)' function

        function HelpMsg (SectID,MessageNum)
        {
          var DataSrc = "../App-code/help/helpmsg.php?sect-ID=" + SectID + "&text-ID=" + MessageNum ;
          GetData(DataSrc,"HelpText") ;
          clearTimeout(HelpTimer) ;
        }


      // Define the 'ClearHelpMsg(SectID) function

        function ClearHelpMsg()
        {
          var DataSrc = "../App-code/help/helpmsg.php?sect-ID=null&text-ID=0" ;
          GetData(DataSrc,"HelpText") ;
          clearTimeout(HelpTimer) ;
        }


      // TimedHelpMsg(SectID,MessageNum)' function

        function TimedHelpMsg(SectID,MessageNum)
        {
          HelpMsg(SectID,MessageNum) ;
          HelpTimer = setTimeout("ClearHelpMsg()", HelpTimeout) ;
        }
 


      ///////////////////////////
      // Give greating message //
      ///////////////////////////



      /////////////////////////////////////////////////
      // Output the result XHTML page to the browser //
      /////////////////////////////////////////////////


