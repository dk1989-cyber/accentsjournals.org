function generate_citations(p) {
	if (p == "paper") {
		m = $("#modification_type").val();
		if (m == "Retraction") {
			$("#citation").removeAttr("readonly");
			return true;
		} else {
			$("#citation").attr("readonly", true);
		}
	}
	author_name_cite = "";
	author_name_cite_mla = "";
	author_name_cite_ieee = "";
	author_name_cite_apa = "";
	authot_name_cite_harward = "";
	no_of_author = $('#no_authors').val();
	temp_mla = [];
	temp_ieee = [];
	for (var i = 1; i <= no_of_author; i++) {
		if ($("#first_name_" + i).val() != "") {
			first_name = $("#first_name_" + i).val();
			last_name = $("#last_name_" + i).val();
			middle_name = $("#middle_name_" + i).val();
			fn = (first_name.trim() != "") ? (capitalizeFirstLetter(first_name.trim())) : "";
			mn = (middle_name.trim() != "") ? (capitalizeFirstLetter(middle_name.trim())) : "";
			ln = (last_name.trim() != "") ? (capitalizeFirstLetter(last_name.trim())) : "";
			fnLen = fn.length;
			mnLen = mn.length;
			lnLen = ln.length;
			//last author //if no of author 1 it will run first time
			if (i == no_of_author) {
				if (lnLen > 1) {
					//for Vancuvar Style
					if (fn !== "" && mn !== "") {
						author_name_cite += ln + " " + fn[0] + mn[0] + "";
						//mla
						if (i < 2) {
							author_name_cite_mla += ln + ", " + fn + " " + mn;
							temp_cite_mla = ln + ", " + fn + " " + mn;
							temp_mla.push(temp_cite_mla);
						} else if (i == 2) {
							author_name_cite_mla = temp_mla[0];
							author_name_cite_mla += ", and " + fn + " " + mn + " " + ln;
						} else if (i > 2) {
							author_name_cite_mla = temp_mla[0] + " et al. ";
						}
						//IEEE citation
						if (i == 6) {
							author_name_cite_ieee += fn[0] + " " + mn[0] + "." + " " + ln;
							temp_cite_ieee = fn[0] + "." + " " + mn[0] + "." + " " + ln;
							temp_ieee.push(temp_cite_ieee);
						}
						if (i > 6) {
							author_name_cite_ieee = temp_cite_ieee.join();
							author_name_cite_ieee += " et al. ";
						} else {
							if (author_name_cite_ieee != "") {
								author_name_cite_ieee += ", and" + fn[0] + "." + " " + " " + ln;
							} else {
								author_name_cite_ieee += fn[0] + "." + " " + " " + ln;
							}
						}
						//Close Citation
					} else if (fn !== "" && mn == "") {
						author_name_cite += ln + " " + fn[0] + "";
						//Ashutosh Kumar   (i=no of author)
						//middlename empty
						if (i < 2) {
							//MLA Cite
							author_name_cite_mla += ln + ", " + fn;
							temp_cite_mla = ln + ", " + fn;
							temp_mla.push(temp_cite_mla);
						} else if (i == 2) {
							author_name_cite_mla = temp_mla[0];
							author_name_cite_mla += ", and " + fn + " " + ln;
						} else if (i > 2) {
							author_name_cite_mla = temp_mla[0] + " et al. ";
						}
						//Close MLA Cite
						//IEEE Cite
						if (i == 6) {
							author_name_cite_ieee += fn[0] + "." + " " + ln;
							temp_cite_ieee = fn[0] + "." + " " + ln;
							temp_ieee.push(temp_cite_ieee);
						}
						if (i > 6) {
							author_name_cite_ieee = temp_cite_ieee.join();
							author_name_cite_ieee += "et al. ";
						} else {
							if (author_name_cite_ieee != "") {
								author_name_cite_ieee += ", and " + fn[0] + "." + " " + " " + ln;
							} else {
								author_name_cite_ieee += fn[0] + "." + " " + " " + ln;
							}
						}
						//Close IEEE Cite
					} else if (mn !== "" && fn == "") {
						author_name_cite += ln + " " + mn[0] + "";
						// Kumar   (i=no of author)
						///author_name_cite_mla+=ln+", "+kumar+"";
						//first name empty
						if (i < 2) {
							author_name_cite_mla += ln + ", " + mn;
							temp_cite_mla = ln + ", " + mn;
							temp_mla.push(temp_cite_mla);
						} else if (i == 2) {
							author_name_cite_mla = temp_mla[0];
							author_name_cite_mla += ", and " + ln;
						} else if (i > 2) {
							author_name_cite_mla = temp_mla[0] + " et al. ";
						}
						//IEEE Cite
						if (i == 6) {
							author_name_cite_ieee += ln;
							temp_cite_ieee = ln;
							temp_ieee.push(temp_cite_ieee);
						}
						if (i > 6) {
							author_name_cite_ieee = temp_cite_ieee.join();
							author_name_cite_ieee += " et al. ";
						} else {
							// author_name_cite_ieee+=ln;
							if (author_name_cite_ieee != "") {
								author_name_cite_ieee += ", and " + ln;
							} else {
								author_name_cite_ieee += ln;
							}
						}
						//Close IEEE Cite
					}
				} else if (mnLen > 1) {
					if (fn !== "" && ln !== "") {
						author_name_cite += mn + " " + fn[0] + ln[0] + "";
						// author_name_cite_mla+=ln+", "+fn+ " "+mn;
						//last name empty
						if (i < 2) {
							author_name_cite_mla += ln + ", " + fn + " " + mn;
							temp_cite_mla = ln + ", " + fn + " " + mn;
							temp_mla.push(temp_cite_mla);
						} else if (i == 2) {
							author_name_cite_mla = temp_mla[0];
							author_name_cite_mla += ", and " + ln;
						} else if (i > 2) {
							author_name_cite_mla = temp_mla[0] + " et al. ";
						}
						//IEEE Cite
						if (i == 6) {
							author_name_cite_ieee += fn[0] + "." + " " + mn[0] + "." + " " + ln;
							temp_cite_ieee = fn[0] + "." + " " + mn[0] + "." + " " + ln;
							temp_ieee.push(temp_cite_ieee);
						}
						if (i > 6) {
							author_name_cite_ieee = temp_cite_ieee.join();
							author_name_cite_ieee += " et al. ";
						} else {
							// author_name_cite_ieee+=fn[0]+"."+" "+" "+ln;
							if (author_name_cite_ieee != "") {
								//author_name_cite_ieee+=", and "+ln;
								author_name_cite_ieee += ", and " + fn[0] + "." + " " + mn[0] + "." + " " + ln;
							} else {
								author_name_cite_ieee += fn[0] + "." + " " + mn[0] + "." + " " + ln;
							}
						}
						//Close IEEE Cite
					} else if (fn !== "" && ln == "") {
						author_name_cite += mn + " " + fn[0] + "";
						//author_name_cite_mla+=ln+", "+fn+ " "+mn;
						//firt+middle+
						if (i < 2) {
							author_name_cite_mla += fn + " " + mn;
							temp_cite_mla = fn + " " + mn;
							temp_mla.push(temp_cite_mla);
						} else if (i == 2) {
							author_name_cite_mla = temp_mla[0];
							author_name_cite_mla += ", and " + mn;
						} else if (i > 2) {
							author_name_cite_mla = temp_mla[0] + " et al. ";
						}
						//IEEE Cite
						//lname=empty
						if (i == 6) {
							author_name_cite_ieee += fn[0] + "." + " " + mn[0] + ".";
							temp_cite_ieee = fn[0] + "." + " " + mn[0] + ".";
							temp_ieee.push(temp_cite_ieee);
						}
						if (i > 6) {
							author_name_cite_ieee = temp_cite_ieee.join();
							author_name_cite_ieee += " et al. ";
						} else {
							if (author_name_cite_ieee != "") {
								author_name_cite_ieee += ", and " + fn[0] + "." + " " + mn[0] + ".";
							} else {
								author_name_cite_ieee += fn[0] + "." + " " + mn[0] + ".";
							}
						}
						//Close IEEE Cite
					} else if (ln !== "" && fn == "") {
						author_name_cite += mn + " " + ln[0] + "";
						if (i < 2) {
							author_name_cite_mla += ln + ", " + mn;
							temp_cite_mla = ln + ", " + mn;
							temp_mla.push(temp_cite_mla);
						} else if (i == 2) {
							author_name_cite_mla = temp_mla[0];
							author_name_cite_mla += ", and " + mn;
						} else if (i > 2) {
							author_name_cite_mla = temp_mla[0] + " et al. ";
						}
						//IEEE Cite
						//fname empty
						if (i == 6) {
							author_name_cite_ieee += mn[0] + "." + " " + ln;
							temp_cite_ieee = mn[0] + "." + " " + ln;
							temp_ieee.push(temp_cite_ieee);
						}
						if (i > 6) {
							author_name_cite_ieee = temp_cite_ieee.join();
							author_name_cite_ieee += " et al. ";
						} else {
							// author_name_cite_ieee+=mn[0]+"."+" "+ln;
							if (author_name_cite_ieee != "") {
								author_name_cite_ieee += ", and " + mn[0] + "." + " " + ln;
							} else {
								author_name_cite_ieee += fn[0] + "." + " " + mn[0] + ".";
							}
						}
						//Close IEEE Cite
					}
				} else if (fnLen > 1) {
					if (mn !== "" && ln !== "") {
						//fname+mname+lname
						author_name_cite += fn + " " + ln[0] + "";
						if (i < 2) {
							author_name_cite_mla += ln + ", " + fn + " " + mn;
							temp_cite_mla = ln + ", " + fn + " " + mn;
							temp_mla.push(temp_cite_mla);
						} else if (i == 2) {
							author_name_cite_mla = temp_mla[0];
							author_name_cite_mla += ", and" + fn + " " + mn + " " + ln;
						} else if (i > 2) {
							author_name_cite_mla = temp_mla[0] + " et al. ";
						}
						//IEEE Cite
						if (i == 6) {
							author_name_cite_ieee += fn[0] + "." + " " + mn[0] + "." + " " + ln[0];
							temp_cite_ieee = fn[0] + "." + " " + mn[0] + "." + " " + ln;
							temp_ieee.push(temp_cite_ieee);
						}
						if (i > 6) {
							author_name_cite_ieee = temp_cite_ieee.join();
							author_name_cite_ieee += " et al. ";
						} else {
							// author_name_cite_ieee+=fn[0]+"."+" "+mn[0]+"."+" "+ln[0];
							if (author_name_cite_ieee != "") {
								author_name_cite_ieee += ", and " + fn[0] + "." + " " + mn[0] + "." + " " + ln[0];
							} else {
								author_name_cite_ieee += fn[0] + "." + " " + mn[0] + "." + " " + ln[0];
							}
						}
						//Close IEEE Cite
					}
					if (ln !== "" && mn !== "") {
						author_name_cite += fn + " " + mn[0] + "";
						if (i < 2) {
							author_name_cite_mla += ln + ", " + fn + " " + mn;
							temp_cite_mla = ln + ", " + fn + " " + mn;
							temp_mla.push(temp_cite_mla);
						} else if (i == 2) {
							author_name_cite_mla = temp_mla[0];
							author_name_cite_mla += ", and " + fn + " " + mn + " " + ln;
						} else if (i > 2) {
							author_name_cite_mla = temp_mla[0] + " et al. ";
						}
						//IEEE Cite
						if (i == 6) {
							author_name_cite_ieee += fn[0] + "." + " " + mn[0] + "." + " " + ln;
							temp_cite_ieee = fn[0] + "." + " " + mn[0] + "." + " " + ln;
							temp_ieee.push(temp_cite_ieee);
						}
						if (i > 6) {
							author_name_cite_ieee = temp_cite_ieee.join();
							author_name_cite_ieee += " et al. ";
						} else {
							if (author_name_cite_ieee != "") {
								author_name_cite_ieee += ", and " + fn[0] + "." + " " + mn[0] + "." + ln;
							} else {
								author_name_cite_ieee += fn[0] + "." + " " + mn[0] + "." + ln;
							}
						}
						//Close IEEE Cite
					} else {
						author_name_cite += fn;
						if (i < 2) {
							author_name_cite_mla += fn;
							temp_cite_mla = fn;
							temp_mla.push(temp_cite_mla);
						} else if (i == 2) {
							author_name_cite_mla = temp_mla[0];
							author_name_cite_mla += ", and " + fn;
						} else if (i > 2) {
							author_name_cite_mla = temp_mla[0] + " et al. ";
						}
						//IEEE Cite
						if (i == 6) {
							author_name_cite_ieee += fn[0] + ".";
							temp_cite_ieee = fn[0] + ".";
							temp_ieee.push(temp_cite_ieee);
						}
						if (i > 6) {
							author_name_cite_ieee = temp_cite_ieee.join();
							author_name_cite_ieee += " et al. ";
						} else {
							if (author_name_cite_ieee != "") {
								author_name_cite_ieee += ", and " + fn[0] + ".";
							} else {
								author_name_cite_ieee += fn[0] + ".";
							}
						}
						//Close IEEE Cite
					}
				} else if (fnLen == 1 && mnLen == 1 && lnLen == 1) {
					author_name_cite += ln + " " + fn[0] + mn[0] + "";
					if (i < 2) {
						author_name_cite_mla += ln + ", " + fn + " " + mn;
						temp_cite_mla = ln + ", " + fn + " " + mn;
						temp_mla.push(temp_cite_mla);
					} else if (i == 2) {
						author_name_cite_mla = temp_mla[0];
						author_name_cite_mla += ", and " + fn + " " + mn + " " + ln;
					} else if (i > 2) {
						author_name_cite_mla = temp_mla[0] + " et al. ";
					}
					//IEEE Cite
					if (i == 6) {
						author_name_cite_ieee += fn[0] + "." + " " + mn[0] + "." + " " + ln;
						temp_cite_ieee = fn[0] + "." + " " + mn[0] + "." + " " + ln;
						temp_ieee.push(temp_cite_ieee);
					}
					if (i > 6) {
						author_name_cite_ieee = temp_cite_ieee.join();
						author_name_cite_ieee += " et al. ";
					} else {
						//  
						if (author_name_cite_ieee != "") {
							author_name_cite_ieee += ", and " + fn[0] + "." + " " + mn[0] + "." + " " + ln;
						} else {
							author_name_cite_ieee += fn[0] + "." + " " + mn[0] + "." + " " + ln;
						}
					}
					//Close IEEE Cite
				}
			}
			//rest authour
			else {
				if (lnLen > 1) {
					if (fn !== "" && mn !== "") {
						author_name_cite += ln + " " + fn[0] + mn[0] + ", ";
						//fname+mname+lname
						if (i < 2) {
							author_name_cite_mla += ln + ", " + fn + " " + mn;
							temp_cite_mla = ln + ", " + fn + " " + mn;
							temp_mla.push(temp_cite_mla);
						} else if (i == 2) {
							author_name_cite_mla = temp_mla[0];
							author_name_cite_mla += ", and " + fn + " " + mn + " " + ln;
						} else if (i > 2) {
							author_name_cite_mla = temp_mla[0] + " et al. ";
						}
						//IEEE Citation
						if (i == 6) {
							author_name_cite_ieee += fn[0] + "." + " " + ln;
							temp_cite_ieee = fn[0] + "." + " " + ln;
							temp_ieee.push(temp_cite_ieee);
						}
						if (i > 6) {
							author_name_cite_ieee = temp_cite_ieee.join();
							author_name_cite_ieee += " et al. ";
						} else {
							//author_name_cite_ieee+=fn[0]+"."+" "+" "+ln;
							// if(author_name_cite_ieee!=""){
							//    author_name_cite_ieee+=", and "+fn[0]+"."+" "+" "+ln;
							// }
							// else{
							// }
							author_name_cite_ieee += fn[0] + "." + " " + " " + ln;
						}
						//Close IEEE Citation
					} else if (fn !== "" && mn == "") {
						author_name_cite += ln + " " + fn[0] + ", ";
						if (i < 2) {
							author_name_cite_mla += ln + ", " + fn;
							temp_cite_mla = ln + ", " + fn;
							temp_mla.push(temp_cite_mla);
						} else if (i == 2) {
							author_name_cite_mla = temp_mla[0];
							author_name_cite_mla += ", and " + fn + " " + ln;
						} else if (i > 2) {
							author_name_cite_mla = temp_mla[0] + " et al. ";
						}
						//IEEE Citation
						if (i == 6) {
							author_name_cite_ieee += fn[0] + "." + " " + ln;
							temp_cite_ieee = fn[0] + "." + " " + ln;
							temp_ieee.push(temp_cite_ieee);
						}
						if (i > 6) {
							author_name_cite_ieee = temp_cite_ieee.join();
							author_name_cite_ieee += "et al. ";
						} else {
							//author_name_cite_ieee+=fn[0]+"."+" "+" "+ln;
							// if(author_name_cite_ieee!=""){
							//      author_name_cite_ieee+=", and "+fn[0]+"."+" "+" "+ln;
							// }
							// else{
							//  }
							author_name_cite_ieee += fn[0] + "." + " " + " " + ln;
						}
						//Close IEEE Citation
					} else if (mn !== "" && fn == "") {
						author_name_cite += ln + " " + mn[0] + ", ";
						//mname+lanme;
						if (i < 2) {
							author_name_cite_mla += ln + ", " + mn;
							temp_cite_mla = ln + ",  " + mn;
							temp_mla.push(temp_cite_mla);
						} else if (i == 2) {
							author_name_cite_mla = temp_mla[0];
							author_name_cite_mla += ", and " + mn + " " + ln;
						} else if (i > 2) {
							author_name_cite_mla = temp_mla[0] + " et al. ";
						}
						//IEEE Citation
						if (i == 6) {
							author_name_cite_ieee += mn[0] + "." + " " + ln;
							temp_cite_ieee = mn[0] + "." + " " + ln;
							temp_ieee.push(temp_cite_ieee);
						}
						if (i > 6) {
							author_name_cite_ieee = temp_cite_ieee.join();
							author_name_cite_ieee += " et al. ";
						} else {
							// author_name_cite_ieee+=mn[0]+"."+" "+ln;
							//  if(author_name_cite_ieee!=""){
							//        author_name_cite_ieee+=", and "+mn[0]+"."+" "+" "+ln;
							//   }
							//   else{
							//       author_name_cite_ieee+=mn[0]+"."+" "+" "+ln;
							//    }
							author_name_cite_ieee += mn[0] + "." + " " + " " + ln;
						}
						//Close IEEE Citation
					}
				} else if (mnLen > 1) {
					if (fn !== "" && ln !== "") {
						author_name_cite += mn + " " + fn[0] + ln[0] + ", ";
						if (i < 2) {
							author_name_cite_mla += ln + ", " + fn + " " + mn;
							temp_cite_mla = ln + ",  " + fn + " " + mn;
							temp_mla.push(temp_cite_mla);
						} else if (i == 2) {
							author_name_cite_mla = temp_mla[0];
							author_name_cite_mla += ", and " + fn + " " + mn + " " + ln;
						} else if (i > 2) {
							author_name_cite_mla = temp_mla[0] + " et al. ";
						}
						//IEEE Citation
						if (i == 6) {
							author_name_cite_ieee += fn[0] + "." + " " + mn[0] + "." + "  " + ln;
							temp_cite_ieee = fn[0] + "." + " " + mn[0] + "." + "  " + ln;
							temp_ieee.push(temp_cite_ieee);
						}
						if (i > 6) {
							author_name_cite_ieee = temp_cite_ieee.join();
							author_name_cite_ieee += " et al. ";
						} else {
							// author_name_cite_ieee+=fn[0]+"."+" "+" "+ln;
							// if(author_name_cite_ieee!=""){
							//      author_name_cite_ieee+=", and "+fn[0]+"."+" "+mn[0]+"."+"  "+ln;
							// }
							// else{
							//  }
							author_name_cite_ieee += fn[0] + "." + " " + mn[0] + "." + " " + ln;
						}
						//Close IEEE Citation
					} else if (fn !== "" && ln == "") {
						author_name_cite += mn + " " + fn[0] + ", ";
						//fname+mn
						if (i < 2) {
							author_name_cite_mla += fn + " " + mn;
							temp_cite_mla = fn + " " + mn;
							temp_mla.push(temp_cite_mla);
						} else if (i == 2) {
							author_name_cite_mla = temp_mla[0];
							author_name_cite_mla += ", and " + fn + " " + mn;
						} else if (i > 2) {
							author_name_cite_mla = temp_mla[0] + " et al. ";
						}
						//IEEE citation
						if (i == 6) {
							author_name_cite_ieee += fn[0] + "." + " " + mn[0] + ".";
							temp_cite_ieee = fn[0] + "." + " " + mn[0] + ".";
							temp_ieee.push(temp_cite_ieee);
						}
						if (i > 6) {
							author_name_cite_ieee = temp_cite_ieee.join();
							author_name_cite_ieee += "et al. ";
						} else {
							author_name_cite_ieee += fn[0] + "." + " " + mn[0] + ".";
						}
						//Close IEEE Cite
					} else if (ln !== "" && fn == "") {
						author_name_cite += mn + " " + ln[0] + ", ";
						if (i < 2) {
							author_name_cite_mla += ln + ", " + mn;
							temp_cite_mla = ln + ",  " + mn;
							temp_mla.push(temp_cite_mla);
						} else if (i == 2) {
							author_name_cite_mla = temp_mla[0];
							author_name_cite_mla += ", and " + mn + " " + ln;
						} else if (i > 2) {
							author_name_cite_mla = temp_mla[0] + " et al. ";
						}
						//IEEE citation
						if (i == 6) {
							author_name_cite_ieee += mn[0] + "." + " " + ln;
							temp_cite_ieee = mn[0] + "." + " " + ln;
							temp_ieee.push(temp_cite_ieee);
						}
						if (i > 6) {
							author_name_cite_ieee = temp_cite_ieee.join();
							author_name_cite_ieee += " et al. ";
						} else {
							// author_name_cite_ieee+=mn[0]+"."+" "+" "+ln;
							// if(author_name_cite_ieee!=""){
							//   author_name_cite_ieee+=", and "+mn[0]+"."+" "+" "+ln;
							// } 
							// else{
							// }
							author_name_cite_ieee += mn[0] + "." + " " + " " + ln;
						}
						//Close IEEE Cite
					}
				} else if (fnLen > 1) {
					if (mn !== "" && ln !== "") {
						author_name_cite += fn + " " + ln[0] + ", ";
						if (i < 2) {
							author_name_cite_mla += ln + ", " + fn + " " + mn;
							temp_cite_mla = ln + ",  " + fn + " " + mn;
							temp_mla.push(temp_cite_mla);
						} else if (i == 2) {
							author_name_cite_mla = temp_mla[0];
							author_name_cite_mla += ", and " + fn + " " + mn + " " + ln;
						} else if (i > 2) {
							author_name_cite_mla = temp_mla[0] + " et al. ";
						}
						//IEEE citation
						if (i == 6) {
							author_name_cite_ieee += fn[0] + "." + mn[0] + "." + " " + " " + ln;
							temp_cite_ieee = fn[0] + "." + " " + mn[0] + "." + " " + ln;
							temp_ieee.push(temp_cite_ieee);
						}
						if (i > 6) {
							author_name_cite_ieee = temp_cite_ieee.join();
							author_name_cite_ieee += " et al. ";
						} else {
							//author_name_cite_ieee+=fn[0]+"."+" "+" "+ln;
							// if(author_name_cite_ieee!=""){
							//   author_name_cite_ieee+=", and "+fn[0]+"."+" "+mn[0]+"."+" "+ln;
							// } 
							// else{
							//   author_name_cite_ieee+=fn[0]+"."+" "+mn[0]+"."+" "+ln;
							// }
							author_name_cite_ieee += fn[0] + "." + " " + mn[0] + "." + " " + ln;
						}
						//Close IEEE Cite
					}
					if (ln !== "" && mn !== "") {
						author_name_cite += fn + " " + mn[0] + ", ";
						if (i < 2) {
							author_name_cite_mla += ln + ", " + mn;
							temp_cite_mla = ln + ",  " + mn;
							temp_mla.push(temp_cite_mla);
						} else if (i == 2) {
							author_name_cite_mla = temp_mla[0];
							author_name_cite_mla += ", and " + fn + " " + mn + " " + ln;
						} else if (i > 2) {
							author_name_cite_mla = temp_mla[0] + " et al. ";
						}
						//IEEE citation
						if (i == 6) {
							author_name_cite_ieee += fn[0] + "." + " " + ln;
							temp_cite_ieee = fn[0] + "." + " " + ln;
							temp_ieee.push(temp_cite_ieee);
						}
						if (i > 6) {
							author_name_cite_ieee = temp_cite_ieee.join();
							author_name_cite_ieee += "et al. ";
						} else {
							author_name_cite_ieee += fn[0] + "." + " " + " " + ln;
						}
						//Close IEEE Cite
					} else {
						author_name_cite += fn + " " + mn[0] + ln[0] + ", ";
						if (i < 2) {
							author_name_cite_mla += ln + ", " + mn;
							temp_cite_mla = ln + ",  " + mn;
							temp_mla.push(temp_cite_mla);
						} else if (i == 2) {
							author_name_cite_mla = temp_mla[0];
							author_name_cite_mla += ", and " + fn + " " + mn + " " + ln;
						} else if (i > 2) {
							author_name_cite_mla = temp_mla[0] + " et al. ";
						}
						//IEEE citation
						if (i == 6) {
							author_name_cite_ieee += fn[0] + "." + " " + ln;
							temp_cite_ieee = fn[0] + "." + " " + ln;
							temp_ieee.push(temp_cite_ieee);
						}
						if (i > 6) {
							author_name_cite_ieee = temp_cite_ieee.join();
							author_name_cite_ieee += " et al. ";
						} else {
							author_name_cite_ieee += fn[0] + "." + " " + " " + ln;
						}
						//Close IEEE Cite
					}
				} else if (fnLen == 1 && mnLen == 1 && lnLen == 1) {
					author_name_cite += ln + " " + fn[0] + mn[0] + ",";
				}
			}
		}
	}
	author_name_cite;
	page_no_start = $("#page_no_start").val();
	page_no_end = $("#page_no_end").val();
	paper_title = $("#paper_title").val();
	if (p == "paper") {
		author_name_cite += "." + paper_title + "." + "<?=(isset($_SESSION['PAPER_JNAME'])?$_SESSION['PAPER_JNAME']:'-')?>" + "." + < ? = (isset($_SESSION['PAPER_YEAR']) ? $_SESSION['PAPER_YEAR'] : "-") ? > +"; " + < ? = (isset($_SESSION['PAPER_VOLUME']) ? $_SESSION['PAPER_VOLUME'] : "-") ? > +"(" + < ? = (isset($_SESSION['PAPER_ISSUE']) ? $_SESSION['PAPER_ISSUE'] : "-") ? > +")" + ":" + getpageno();
		author_name_cite_mla += "." + paper_title + "." + " “<?=(isset($_SESSION['PAPER_JNAME'])?$_SESSION['PAPER_JNAME']:'')?>.” " + ",vol. " + "<?=(isset($_SESSION['PAPER_VOLUME'])?$_SESSION['PAPER_VOLUME']:" - ")?>" + ",no." + "<?=(isset($_SESSION['PAPER_ISSUE'])?$_SESSION['PAPER_ISSUE']:" - ")?>" + " Month " + "<?=(isset($_SESSION['PAPER_YEAR'])?$_SESSION['PAPER_YEAR']:"
		")?>" + ", " + "pp." + getpageno();
	} else if (p == "press") {
		jname = $("#journals_id").val().split("#")[3];
		year = "#year#";
		volume = "#volume#";
		issue = "#issue#";
		author_name_cite += "." + paper_title + "." + jname + "." + year + ";" + volume + "(" + issue + "):" + getpageno();
	}
	//$("#citation").val(author_name_cite);
	// $("#citation").val(author_name_cite_mla);
	$("#citation").val(author_name_cite_ieee);
}