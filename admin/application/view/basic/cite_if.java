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
				author_name_cite_mla += " and " + fn + " " + mn + " " + ln;
			} else if (i > 2) {
				author_name_cite_mla = temp_mla[0] + " et al. ";
			}
			//IEEE citation & Apa
			if (i <= 6) {
				//ieee
				author_name_cite_ieee += " and " + fn[0] + " " + mn[0] + "." + " " + ln;
				temp_cite_ieee = fn[0] + "." + " " + mn[0] + "." + " " + ln;
				temp_ieee.push(temp_cite_ieee);

				//apa
				author_name_cite_apa += " & " + ln + ", " + fn[0] + "." + " " + mn[0] + ".";
				temp_cite_apa = ln + " " + fn[0] + "." + " " + mn[0] + ".";
				temp_apa.push(temp_cite_apa);

			} 
			else if (i > 6) {
				author_name_cite_ieee = temp_ieee.join();
				author_name_cite_ieee += " et al. ";
				author_name_cite_apa = temp_apa.join();
				author_name_cite_apa += " et al. ";
			}
    }
    //Close Citation
    else if (fn !== "" && mn == "") {
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
					author_name_cite_mla += " and " + fn + " " + ln;
				} else if (i > 2) {
					author_name_cite_mla = temp_mla[0] + " et al. ";
				}
				//Close MLA Cite
				//IEEE Cite
				if (i <= 6) {
					author_name_cite_ieee += " and " + fn[0] + "." + " " + ln + "";
					temp_cite_ieee = fn[0] + "." + " " + ln;
					temp_ieee.push(temp_cite_ieee);

					if (i != 1) {
						author_name_cite_apa += " & " + ln + ", " + fn[0] + "." + " ";

					} else {
						author_name_cite_apa += "" + ln + ", " + fn[0] + "." + " ";
					}

					temp_cite_apa = ln + "," + " " + fn[0] + "." + ".";
					temp_apa.push(temp_cite_apa);

				}
				if (i > 6) {
					author_name_cite_ieee = temp_ieee.join();
					author_name_cite_ieee += " et al. ";
					author_name_cite_apa = temp_apa.join();
					author_name_cite_apa += " et al. ";
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
				if (i <= 6) {
					author_name_cite_ieee += " and " + mn[0] + "." + " " + ln + "";
					temp_cite_ieee = ln;
					temp_ieee.push(temp_cite_ieee);

					author_name_cite_apa += " & " + ln + ", " + mn[0] + ".";
					temp_cite_apa = ln + "," + " " + mn[0] + ".";
					temp_apa.push(temp_cite_apa);

				}
				if (i > 6) {
					author_name_cite_ieee = temp_ieee.join();
					author_name_cite_ieee += " et al. ";

					author_name_cite_apa = temp_apa.join();
					author_name_cite_apa += " et al. ";
				} else {
					// author_name_cite_ieee+=ln;
					if (author_name_cite_ieee != "") {
						//	author_name_cite_ieee += ", and " + ln;
					}
				}
    } //Close IEEE Cite
} 
else if (mnLen > 1) {
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
			if (i <= 6) {
				author_name_cite_ieee += " and " + fn[0] + "." + " " + mn[0] + "." + " " + ln + "";
				temp_cite_ieee = fn[0] + "." + " " + mn[0] + "." + " " + ln;
				temp_ieee.push(temp_cite_ieee);

				author_name_cite_apa += " & " + ln + ", " + " " + mn[0] + ".";
				temp_cite_apa = ln + "," + " " + mn[0] + ".";
				temp_apa.push(temp_cite_apa);

			}
			if (i > 6) {
				author_name_cite_ieee = temp_ieee.join();
				author_name_cite_ieee += " et al. ";

				author_name_cite_apa = temp_apa.join();
				author_name_cite_apa += " et al. ";

			} else {
				// author_name_cite_ieee+=fn[0]+"."+" "+" "+ln;
				if (author_name_cite_ieee != "") {
					//	author_name_cite_ieee += " and " + fn[0] + "." + " " + mn[0] + "." + " " + ln;
				} else {
					//author_name_cite_ieee += fn[0] + "." + " " + mn[0] + "." + " " + ln;
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
			if (i <= 6) {
				author_name_cite_ieee += " and " + fn[0] + "." + " " + mn[0] + "." + "";
				temp_cite_ieee = fn[0] + "." + " " + mn[0] + ".";
				temp_ieee.push(temp_cite_ieee);

				//apa
				author_name_cite_apa += " & " + mn + ", " + fn[0] + "." + "";
				temp_cite_apa = mn + "," + " " + fn[0] + ".";
				temp_apa.push(temp_cite_apa);

			}
			if (i > 6) {
				author_name_cite_ieee = temp_ieee.join();
				author_name_cite_ieee += " et al. ";

				author_name_cite_apa = temp_apa.join();
				author_name_cite_apa += " et al. ";

			} else {
				if (author_name_cite_ieee != "") {
					//author_name_cite_ieee += " and " + fn[0] + "." + " " + mn[0] + ".";
				} else {
					//author_name_cite_ieee += fn[0] + "." + " " + mn[0] + ".";
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
				author_name_cite_mla += " and " + mn;
			} else if (i > 2) {
				author_name_cite_mla = temp_mla[0] + " et al. ";
			}
			//IEEE Cite
			//fname empty
			if (i <= 6) {
				author_name_cite_ieee += " and " + mn[0] + "." + " " + ln + ", ";;
				temp_cite_ieee = mn[0] + "." + " " + ln;
				temp_ieee.push(temp_cite_ieee);


				author_name_cite_apa += " & " + mn + ", " + fn[0] + "." + "";
				temp_cite_apa = mn + "," + " " + fn[0] + ".";
				temp_apa.push(temp_cite_apa);

			}
			if (i > 6) {
				author_name_cite_ieee = temp_ieee.join();
				author_name_cite_ieee += " et al. ";

				author_name_cite_apa = temp_apa.join();
				author_name_cite_apa += " et al. ";
			}
    }
    //Close IEEE Cite
}
else if (fnLen > 1) {
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
			if (i <= 6) {
				author_name_cite_ieee += " and " + fn[0] + "." + " " + mn[0] + "." + " " + ln[0] + "";
				temp_cite_ieee = fn[0] + "." + " " + mn[0] + "." + " " + ln;
				temp_ieee.push(temp_cite_ieee);


				//apa
				author_name_cite_apa += " & " + ln + ", " + fn[0] + "." + " " + mn[0] + ".";
				temp_cite_apa = ln + ", " + fn[0] + "." + " " + mn[0] + ".";
				temp_apa.push(temp_cite_apa);

			}
			if (i > 6) {
				author_name_cite_ieee = temp_ieee.join();
				author_name_cite_ieee += " et al. ";

				author_name_cite_apa = temp_apa.join();
				author_name_cite_apa += " et al. ";
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
			if (i <= 6) {
				author_name_cite_ieee += " and " + fn[0] + "." + " " + mn[0] + "." + " " + ln + "";
				temp_cite_ieee = fn[0] + "." + " " + mn[0] + "." + " " + ln;
				temp_ieee.push(temp_cite_ieee);


				author_name_cite_apa += " & " + ln + ", " + fn[0] + "." + " " + mn[0] + ".";
				temp_cite_apa = ln + "," + fn[0] + "." + " " + mn[0] + ".";
				temp_apa.push(temp_cite_apa);

			}
			if (i > 6) {
				author_name_cite_ieee = temp_ieee.join();
				author_name_cite_ieee += " et al. ";

				author_name_cite_apa = temp_apa.join();
				author_name_cite_apa += " et al. ";
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
			if (i <= 6) {
				author_name_cite_ieee += " and " + fn + " ";
				temp_cite_ieee = fn[0] + ".";
				temp_ieee.push(temp_cite_ieee);


				author_name_cite_apa += " & " + fn;
				temp_cite_apa = fn;
				temp_apa.push(temp_cite_apa);

			}
			if (i > 6) {
				author_name_cite_ieee = temp_ieee.join();
				author_name_cite_ieee += " et al. ";

				author_name_cite_apa = temp_apa.join();
				author_name_cite_apa += " et al. ";
			}
			//Close IEEE Cite
		}
} 
else if (fnLen == 1 && mnLen == 1 && lnLen == 1) {
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
    if (i <= 6) {
        author_name_cite_ieee += " and " + fn[0] + "." + "  " + mn[0] + "." + " " + ln + "";
        temp_cite_ieee = fn[0] + "." + " " + mn[0] + "." + " " + ln;
        temp_ieee.push(temp_cite_ieee);

        author_name_cite_apa += " & " + ln + ", " + fn[0] + "." + " " + mn[0] + ".";
        temp_cite_apa = ln + "," + fn[0] + "." + " " + mn[0] + ".";
        temp_apa.push(temp_cite_apa);

    } else if (i > 6) {
        author_name_cite_ieee = temp_ieee.join();
        author_name_cite_ieee += " et al. ";

        author_name_cite_apa = temp_apa.join();
        author_name_cite_apa += " et al. ";
    }
    //Close IEEE Cite
}




//else

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
	        if (i <= 6) {
	            author_name_cite_ieee += fn[0] + "." + " " + mn[0] + "." + " " + ln + ", ";
	            temp_cite_ieee = fn[0] + "." + " " + mn[0] + "." + " " + ln;
	            temp_ieee.push(temp_cite_ieee);


	            author_name_cite_apa += ln + ", " + fn[0] + "." + " " + mn[0] + ".";
	            temp_cite_apa = ln + ", " + fn[0] + "." + " " + mn[0] + ".";
	            temp_apa.push(temp_cite_apa);

	        }
	        if (i > 6) {
	            author_name_cite_ieee = temp_ieee.join();
	            author_name_cite_ieee += " et al. ";

	            author_name_cite_apa = temp_apa.join();
	            author_name_cite_apa += " et al. ";

	        } else {
	            //author_name_cite_ieee += fn[0] + "." + " " +mn[0]+"."+ " " + ln;
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
	        if (i <= 6) {
	            author_name_cite_ieee += fn[0] + "." + " " + ln + ", ";
	            temp_cite_ieee = fn[0] + "." + " " + ln;
	            temp_ieee.push(temp_cite_ieee);

	            author_name_cite_apa += ln + ", " + fn[0] + ".";
	            temp_cite_apa = ln + ", " + fn[0] + ".";
	            temp_apa.push(temp_cite_apa);

	        }
	        if (i > 6) {
	            author_name_cite_ieee = temp_ieee.join();
	            author_name_cite_ieee += " et al. ";

	            author_name_cite_apa = temp_apa.join();
	            author_name_cite_apa += " et al. ";

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
	        if (i <= 6) {
	            author_name_cite_ieee += mn[0] + "." + " " + ln + ", ";
	            temp_cite_ieee = mn[0] + "." + " " + ln;
	            temp_ieee.push(temp_cite_ieee);


	            author_name_cite_apa += ln + ", " + fn[0] + "." + " " + mn[0] + ".";
	            temp_cite_apa = ln + ", " + fn[0] + "." + " " + mn[0] + ".";
	            temp_apa.push(temp_cite_apa);

	        }
	        if (i > 6) {
	            author_name_cite_ieee = temp_ieee.join();
	            author_name_cite_ieee += " et al. ";

	            author_name_cite_apa = temp_apa.join();
	            author_name_cite_apa += " et al. ";

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
	        if (i <= 6) {
	            author_name_cite_ieee += fn[0] + "." + " " + mn[0] + "." + "  " + ln + ", ";
	            temp_cite_ieee = fn[0] + "." + " " + mn[0] + "." + "  " + ln;
	            temp_ieee.push(temp_cite_ieee);

	            author_name_cite_apa += ln + ", " + fn[0] + "." + "  " + mn[0] + ".";
	            temp_cite_apa = ln + "," + fn[0] + "." + " " + mn[0] + ".";
	            temp_apa.push(temp_cite_apa);

	        }
	        if (i > 6) {
	            author_name_cite_ieee = temp_ieee.join();
	            author_name_cite_ieee += " et al. ";

	            author_name_cite_apa = temp_apa.join();
	            author_name_cite_apa += " et al. ";

	        } else {

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
	        if (i <= 6) {
	            author_name_cite_ieee += fn[0] + "." + " " + mn + ", ";
	            temp_cite_ieee = fn[0] + "." + " " + mn + ".";
	            temp_ieee.push(temp_cite_ieee);


	            author_name_cite_apa += mn + ", " + fn[0] + ".";
	            temp_cite_apa = mn + "," + fn[0] + ".";
	            temp_apa.push(temp_cite_apa);

	        }
	        if (i > 6) {
	            author_name_cite_ieee = temp_ieee.join();
	            author_name_cite_ieee += " et al. ";

	            author_name_cite_apa = temp_apa.join();
	            author_name_cite_apa += " et al. ";


	        } else {
	            //	author_name_cite_ieee += fn[0] + "." + " " + mn[0] + ".";
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
	        if (i <= 6) {
	            author_name_cite_ieee += mn[0] + "." + " " + ln + ", ";
	            temp_cite_ieee = mn[0] + "." + " " + ln;
	            temp_ieee.push(temp_cite_ieee);

	            author_name_cite_apa += ln + ", " + "  " + mn[0] + ".";
	            temp_cite_apa = ln + ", " + mn[0] + ".";
	            temp_apa.push(temp_cite_apa);

	        }
	        if (i > 6) {
	            author_name_cite_ieee = temp_ieee.join();
	            author_name_cite_ieee += " et al. ";
	            author_name_cite_apa = temp_apa.join();
	            author_name_cite_apa += " et al. ";
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
	        if (i <= 6) {
	            author_name_cite_ieee += fn[0] + "." + mn[0] + "." + " " + " " + ln + ", ";
	            temp_cite_ieee = fn[0] + "." + " " + mn[0] + "." + " " + ln;
	            temp_ieee.push(temp_cite_ieee);

	            author_name_cite_apa += ln + ", " + fn[0] + "." + "  " + mn[0] + ".";
	            temp_cite_apa = ln + ", " + fn[0] + "." + " " + mn[0] + ".";
	            temp_apa.push(temp_cite_apa);
	        }
	        if (i > 6) {
	            author_name_cite_ieee = temp_ieee.join();
	            author_name_cite_ieee += " et al. ";
	            author_name_cite_apa = temp_apa.join();
	            author_name_cite_apa += " et al. ";
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
	        if (i <= 6) {
	            author_name_cite_ieee += fn[0] + "." + " " + ln + ", ";
	            temp_cite_ieee = fn[0] + "." + " " + ln;
	            temp_ieee.push(temp_cite_ieee);

	            author_name_cite_apa += ln + ", " + fn[0] + ".";
	            temp_cite_apa = ln + "," + fn[0] + ".";
	            temp_apa.push(temp_cite_apa);

	        }
	        if (i > 6) {
	            author_name_cite_ieee = temp_ieee.join();
	            author_name_cite_ieee += " et al. ";

	            author_name_cite_apa = temp_apa.join();
	            author_name_cite_apa += " et al. ";
	        } else {
	            //author_name_cite_ieee += fn[0] + "." + " " + " " + ln;
	        }

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

	        if (i <= 6) {
	            //only first name
	            author_name_cite_ieee += fn[0] + "." + " " + ln + ", ";
	            temp_cite_ieee = fn[0] + "." + " " + ln;
	            temp_ieee.push(temp_cite_ieee);
	            //apa
	            author_name_cite_apa += ln + ", " + fn[0] + "." + "  " + mn[0] + ".";
	            temp_cite_apa = ln + ", " + fn[0] + "." + " " + mn[0] + ".";
	            temp_apa.push(temp_cite_apa);


	        }
	        if (i > 6) {
	            author_name_cite_ieee = temp_ieee.join();
	            author_name_cite_ieee += " et al. ";

	            author_name_cite_apa = temp_apa.join();
	            author_name_cite_apa += " et al. ";

	        } else {
	            //author_name_cite_ieee += fn[0] + "." + " " + " " + ln;
	        }
	        //Close 
	    }
	} else if (fnLen == 1 && mnLen == 1 && lnLen == 1) {
	    author_name_cite += ln + " " + fn[0] + mn[0] + ",";
	}
	//close ieee
