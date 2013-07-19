// Group 2 Entertainment site
//
// vers. 0.1 - 20081118.0516
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

      // Define the 'Validate EmailAddress(EmailAddress)' function

        function ValidateEmailAddress (EmailAddress)
        {

          var ValidChars = "aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ0123456789.-@"

          var tld = new Array(268);
              tld[0] = 268
              tld[1] = ".aero";
              tld[1] = ".asia";
              tld[2] = ".biz";
              tld[3] = ".cat";
              tld[4] = ".com";
              tld[5] = ".coop";
              tld[6] = ".edu";
              tld[7] = ".gov";
              tld[8] = ".info";
              tld[9] = ".int";
              tld[10] = ".jobs";
              tld[11] = ".mil";
              tld[12] = ".mobi";
              tld[13] = ".museum";
              tld[14] = ".name";
              tld[15] = ".net";
              tld[16] = ".org";
              tld[17] = ".pro";
              tld[18] = ".tel";
              tld[19] = ".travel";
              tld[20] = ".com";
              tld[21] = ".ac";
              tld[22] = ".ad";
              tld[23] = ".ae";
              tld[24] = ".af";
              tld[25] = ".ag";
              tld[26] = ".ai";
              tld[27] = ".al";
              tld[28] = ".am";
              tld[29] = ".an";
              tld[30] = ".ao";
              tld[31] = ".aq";
              tld[32] = ".ar";
              tld[33] = ".as";
              tld[34] = ".at";
              tld[35] = ".au";
              tld[36] = ".aw";
              tld[37] = ".ax";
              tld[38] = ".az";
              tld[39] = ".ba";
              tld[40] = ".bb";
              tld[41] = ".bd";
              tld[42] = ".be";
              tld[43] = ".bf";
              tld[44] = ".bg";
              tld[45] = ".bh";
              tld[46] = ".bi";
              tld[47] = ".bj";
              tld[48] = ".bm";
              tld[49] = ".bn";
              tld[50] = ".bo";
              tld[51] = ".br";
              tld[52] = ".bs";
              tld[53] = ".bt";
              tld[54] = ".bv";
              tld[55] = ".bw";
              tld[56] = ".by";
              tld[57] = ".bz";
              tld[58] = ".ca";
              tld[59] = ".cc";
              tld[60] = ".cd";
              tld[61] = ".cf";
              tld[62] = ".cg";
              tld[63] = ".ch";
              tld[64] = ".ci";
              tld[65] = ".ck";
              tld[66] = ".cl";
              tld[67] = ".cm";
              tld[68] = ".cn";
              tld[69] = ".co";
              tld[70] = ".cr";
              tld[71] = ".cu";
              tld[72] = ".cv";
              tld[73] = ".cx";
              tld[74] = ".cy";
              tld[75] = ".cz";
              tld[76] = ".de";
              tld[77] = ".dj";
              tld[78] = ".dk";
              tld[79] = ".dm";
              tld[80] = ".do";
              tld[81] = ".dz";
              tld[82] = ".ec";
              tld[83] = ".ee";
              tld[84] = ".eg";
              tld[85] = ".er";
              tld[86] = ".es";
              tld[87] = ".et";
              tld[88] = ".eu";
              tld[89] = ".fi";
              tld[90] = ".fj";
              tld[91] = ".fk";
              tld[92] = ".fm";
              tld[93] = ".fo";
              tld[94] = ".fr";
              tld[95] = ".ga";
              tld[96] = ".gb";
              tld[97] = ".gd";
              tld[98] = ".ge";
              tld[99] = ".gf";
              tld[100] = ".gg";
              tld[101] = ".gh";
              tld[102] = ".gi";
              tld[103] = ".gl";
              tld[104] = ".gm";
              tld[105] = ".gn";
              tld[106] = ".gp";
              tld[107] = ".gq";
              tld[108] = ".gr";
              tld[109] = ".gs";
              tld[110] = ".gt";
              tld[111] = ".gu";
              tld[112] = ".gw";
              tld[113] = ".gy";
              tld[114] = ".hk";
              tld[115] = ".hm";
              tld[116] = ".hn";
              tld[117] = ".hr";
              tld[118] = ".ht";
              tld[119] = ".hu";
              tld[120] = ".id";
              tld[121] = ".ie";
              tld[122] = ".il";
              tld[123] = ".im";
              tld[124] = ".in";
              tld[125] = ".io";
              tld[126] = ".iq";
              tld[127] = ".ir";
              tld[128] = ".is";
              tld[129] = ".it";
              tld[130] = ".je";
              tld[131] = ".jm";
              tld[132] = ".jo";
              tld[133] = ".jp";
              tld[134] = ".ke";
              tld[135] = ".kg";
              tld[136] = ".kh";
              tld[137] = ".ki";
              tld[138] = ".km";
              tld[139] = ".kn";
              tld[140] = ".kp";
              tld[141] = ".kr";
              tld[142] = ".kw";
              tld[143] = ".ky";
              tld[144] = ".kz";
              tld[145] = ".la";
              tld[146] = ".lb";
              tld[147] = ".lc";
              tld[148] = ".li";
              tld[149] = ".lk";
              tld[150] = ".lr";
              tld[151] = ".ls";
              tld[152] = ".lt";
              tld[153] = ".lu";
              tld[154] = ".lv";
              tld[155] = ".ly";
              tld[156] = ".ma";
              tld[157] = ".mc";
              tld[158] = ".md";
              tld[159] = ".me";
              tld[160] = ".mg";
              tld[161] = ".mh";
              tld[162] = ".mk";
              tld[163] = ".ml";
              tld[164] = ".mm";
              tld[165] = ".mn";
              tld[166] = ".mo";
              tld[167] = ".mp";
              tld[168] = ".mq";
              tld[169] = ".mr";
              tld[170] = ".ms";
              tld[171] = ".mt";
              tld[172] = ".mu";
              tld[173] = ".mv";
              tld[174] = ".mw";
              tld[175] = ".mx";
              tld[176] = ".my";
              tld[177] = ".mz";
              tld[178] = ".na";
              tld[179] = ".nc";
              tld[180] = ".ne";
              tld[181] = ".nf";
              tld[182] = ".ng";
              tld[183] = ".ni";
              tld[184] = ".nl";
              tld[185] = ".no";
              tld[186] = ".np";
              tld[187] = ".nr";
              tld[188] = ".nu";
              tld[189] = ".nz";
              tld[190] = ".om";
              tld[191] = ".pa";
              tld[192] = ".pe";
              tld[193] = ".pf";
              tld[194] = ".pg";
              tld[195] = ".ph";
              tld[196] = ".pk";
              tld[197] = ".pl";
              tld[198] = ".pm";
              tld[199] = ".pn";
              tld[200] = ".pr";
              tld[201] = ".ps";
              tld[202] = ".pt";
              tld[203] = ".pw";
              tld[204] = ".py";
              tld[205] = ".qa";
              tld[206] = ".re";
              tld[207] = ".ro";
              tld[208] = ".rs";
              tld[209] = ".ru";
              tld[210] = ".rw";
              tld[211] = ".sa";
              tld[212] = ".sb";
              tld[213] = ".sc";
              tld[214] = ".sd";
              tld[215] = ".se";
              tld[216] = ".sg";
              tld[217] = ".sh";
              tld[218] = ".si";
              tld[219] = ".sj";
              tld[220] = ".sk";
              tld[221] = ".sl";
              tld[222] = ".sm";
              tld[223] = ".sn";
              tld[224] = ".so";
              tld[225] = ".sr";
              tld[226] = ".st";
              tld[227] = ".su";
              tld[228] = ".sv";
              tld[229] = ".sy";
              tld[230] = ".sz";
              tld[231] = ".tc";
              tld[232] = ".td";
              tld[233] = ".tf";
              tld[234] = ".tg";
              tld[235] = ".th";
              tld[236] = ".tj";
              tld[237] = ".tk";
              tld[238] = ".tl";
              tld[239] = ".tm";
              tld[240] = ".tn";
              tld[241] = ".to";
              tld[242] = ".tp";
              tld[243] = ".tr";
              tld[244] = ".tt";
              tld[245] = ".tv";
              tld[246] = ".tw";
              tld[247] = ".tz";
              tld[248] = ".ua";
              tld[249] = ".ug";
              tld[250] = ".uk";
              tld[251] = ".us";
              tld[252] = ".uy";
              tld[253] = ".uz";
              tld[254] = ".va";
              tld[255] = ".vc";
              tld[256] = ".ve";
              tld[257] = ".vg";
              tld[258] = ".vi";
              tld[259] = ".vn";
              tld[260] = ".vu";
              tld[261] = ".wf";
              tld[262] = ".ws";
              tld[263] = ".ye";
              tld[264] = ".yt";
              tld[265] = ".yu";
              tld[266] = ".za";
              tld[267] = ".zm";
              tld[268] = ".zw";

          var InvalidChars = false ;

          for ( var i=0 ; i <= EmailAddress.length ; i++ )
          {
            if ( ValidChars.indexOf(EmailAddress.charAt(i)) == -1)
            {
              InvalidChars = true ;
            }
          }

          if ( InvalidChars == false )
          {

            SepAddr = EmailAddress.indexOf("@");

            if ( SepAddr == -1 ) 
            {
              InvalidEmail(EmailAddress,"No @ character");
              return false ;
            }
            else
            {
              var LeftSide = EmailAddress.substring(0,EmailAddress.indexOf("@"));
              var RightSide = EmailAddress.substr(EmailAddress.indexOf("@")+1);

              if ( LeftSide.length > 0 && RightSide.length > 0 )
              {
                if ( RightSide.indexOf("@") == -1 )
                {
                  var ValidTLD = false ;
                  var tldIndex = 0 ;

                  for ( var i = 1 ; i <= tld[0] ; i++ )
                  {
                    if ( RightSide.lastIndexOf( tld[i] ) != -1 )
                    {
                      ValidTLD = true ;
                      tldIndex = RightSide.lastIndexOf( tld[i] ) ;
                    }
                  }

                  if ( ValidTLD = true )
                  {
                    DomainName = RightSide.substring(0,tldIndex) ;

                    if ( DomainName.length > 0 )
                    {
                      SendToEmailAddress(EmailAddress);
                      return true ;
                    }
                    else
                    {
                      InvalidEmail(EmailAddress,"Invalid domain on Right Side");
                      return false ;
                    }
                  }
                  else
                  {
                    InvalidEmail(EmailAddress,"Invalid TLD on Right Side");
                    return false ;
                  }
                }
                else
                {
                  InvalidEmail(EmailAddress,"One more @ at RightSide");
                  return false ;
                }
              }
              else
              {
                InvalidEmail(EmailAddress,"LeftSide or RightSide length = 0");
                return false;
              }
            }
          }
          else
          {
            InvalidEmail(EmailAddress,"InvalidChars = true");
            return false;
          }
        }


      // Define the 'SendToEmailAddress(EmailAddress)' function

        function SendToEmailAddress (EmailAddress)
        {
          window.alert("A mail is going to be sent to the address\n\n" + EmailAddress + "!");
          document.forms[0].action = "mailto:" + EmailAddress ;
          document.forms[0].elements[1].click();
        }


      // Define the 'InvalidEmail(EmailAddress)' function

        function InvalidEmail (EmailAddress,ErrorStr)
        {
           window.alert("The email address\n\n" + EmailAddress + "\n\nis not valid --> " + ErrorStr +"\n\nPlease input a correct email address in the form:\n\nuser@domain.tld" ) ;
        } ;



      ///////////////////////////
      // Give greating message //
      ///////////////////////////



      /////////////////////////////////////////////////
      // Output the result XHTML page to the browser //
      /////////////////////////////////////////////////


