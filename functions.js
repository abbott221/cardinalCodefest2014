			function getCookie(cname)
					{
					cname;
					var name = cname + "=";
					var ca = document.cookie.split(';');
					for(var i=0; i<ca.length; i++)
					  {
					  var c = ca[i].trim();
					  if (c.indexOf(name)==0) return c.substring(name.length,c.length);
					  }
					return "Error inbound captain";
					};
				//Open tags= "%3C" Close tags="%3E" Space="+"  /="%2F"  ;="%3A" !="%21"
				//REcursive functions to search through the cookie strings and cleanse them
			function processCookieOpenTags(cookie)
				{
				var result = "";
				var index=cookie.indexOf("%3C");
				if(index>=0)
				{
					result = cookie.substring(0,index)+"<"+processCookieOpenTags(cookie.substring(index+3));
				}
				return result;
				}

			function processCookieClosedTags(cookie)
				{
				var result = "";
				var index=cookie.indexOf("%3E");
				if(index>=0)
				{
					result = cookie.substring(0,index)+">"+processCookieClosedTags(cookie.substring(index+3));
				}
				return result;
				}

			function processCookieSlash(cookie)
				{
				var result = "";
				var index=cookie.indexOf("%3C");
				if(index>=0)
				{
					result = cookie.substring(0,index)+"/"+processCookieSlash(cookie.substring(index+3));
				}
				return result;
				}

			function processCookieSemiColon(cookie)
				{
				var result = "";
				var index=cookie.indexOf("%3A");
				if(index>=0)
				{
					result = cookie.substring(0,index)+";"+processCookieSemiColon(cookie.substring(index+3));
				}
				return result;
				}

			function processCookieExclamation(cookie)
				{
				var result = "";
				var index=cookie.indexOf("%21");
				if(index>=0)
				{
					result = cookie.substring(0,index)+"!"+processCookieExclamation(cookie.substring(index+3));
				}
				return result;
				}

			function processCookieSpace(cookie)
				{
				var result = "";
				var index=cookie.indexOf("+");
				if(index>=0)
				{
					result = cookie.substring(0,index)+" "+processCookieSpace(cookie.substring(index+1));
				}
				return result;
				}
			//End minor cleanses

			function cookieProcessor(cookie){
			return console.log(processCookieSpace(processCookieExclamation(processCookieSemiColon(processCookieSlash(processCookieClosedTags(processCookieOpenTags(getCookie(cookie))))))));
			}

			function makePage(cookie)
					{
						console.log("What?");
						console.log(newWindow = window.open());
						console.log(newWindow.document.write("<html><head><title>Patient Summary</title></head><body>"+cookieProcessor(cookie)+"</body></html>"));
					} 


