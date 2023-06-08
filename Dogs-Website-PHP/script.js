

// Get the personal computer date using JavaScript
// YYYY-MM-DD hh:mm:ss
function get_today()
{
    d = new Date();
    var today = new Date();
    return today.getFullYear()+'-'+to2(today.getMonth()+1)+'-'+to2(today.getDate())+" "+
        to2(today.getHours()) + ":" +to2(today.getMinutes()) + ":" + to2(today.getSeconds());
}


var wL = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
var wS = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];
var mL = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
var mS = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];

function $(el) 				{ return document.getElementById(el); }		// Short call
function dayW(w) 			{ return w.getDay(); }							// 0-Sunday ..6-Saturday (Object to proceudre)
function thisMonth() 		{ return new Date().getMonth()+1; }				// 1-12
function firstDay(m,y) 		{ return new Date(y, m-1, 1); }					// first day in month year
function lastDay(m,y)  		{ return new Date(y, m-1 + 1, 0); }				// Last day of m
function daysInMonth(m, y) 	{ return new Date(y, m, 0).getDate(); }			// days in month , year
function to2(n) 			{ return (n < 10 ? '0' : '') + n; }				// Convert month and day to 2 digits with leading zero

// Formated day into dd+"/"+mm+"/"+yyyy;
function formatD(d)
{
    dd = to2( d.getDate() );
    mm = to2( d.getMonth()+1 );
    yyyy = d.getFullYear();
    return dd+"/"+mm+"/"+yyyy;
}

// Formated time to hh:mm:ss
function formatT(t)
{
    h = to2(t.getHours());
    m = to2(t.getMinutes());
    s = to2(t.getSeconds());
    return h+":"+m+":"+s;
}

// Convert to date type from dd+"/"+mm+"/"+yyyy to yyyy-mm-dd
function toDate(dateStr) {
    var parts = dateStr.split("/")
    return new Date(parts[2], parts[1] - 1, parts[0])
}

// The click function in a day of the calender
function calenderClick(dt)
{
    currentdate=dt;
    if (calender[''+currentdate+''] != undefined) {
        document.getElementById("desc").value =calender[''+currentdate+''].desc
        document.getElementById("starttime").value =calender[''+currentdate+''].starttime
        document.getElementById("dt").value = dt
    }
    else {
        document.getElementById("desc").value = ''
        document.getElementById("starttime").value = ''
        document.getElementById("dt").value = dt
    }

    document.getElementById('main_form').style.visibility='visible' ; // Show the div 2 inputs + 2 buttons

}


calender = [];
// click on save


function loadL(str1) {
//	localStorage.getItem('mydata')
    //if(localStorage.getItem('mydata')) {
    //	str1=localStorage.getItem('mydata');
    calender1 = JSON.parse(str1); // from json to array of objects
    for (i=0; i<calender1.cal.length; i++) {
        calender[calender1.cal[i].dt] = {"desc":calender1.cal[i].desc,"starttime":calender1.cal[i].starttime};
        if (calender[calender1.cal[i].dt] != undefined) {
            //console.log(calender1.cal[i].dt);
            if( document.getElementById(calender1.cal[i].dt) ) {
                document.getElementById(calender1.cal[i].dt).style.border = "thin red solid";
            }
        }
    }
}

//{"dt":,"desc":,"starttime":};

// click on delete
function deleteCalender(currentdate)
{
    document.getElementById("desc").value = '';
    document.getElementById("starttime").value = '';
    document.getElementById('main_form').style.visibility='hidden';
    delete calender[currentdate];
    console.log(calender)
    document.getElementById(currentdate).style.border="";
}
// Current year and month
var cm = 0;
var cy = 0;

// CalCreatData() return current month and year
// CalCreatData(8) return 8 month current year
// CalCreatData(8,2012) return 8 month 2012 year
function CalCreatData(cm1,cy1)
{
    if (cm1 === undefined ) 	// if month not defined - define month and year
    {
        d = new Date();
        cm = d.getMonth()+1; 	// 0..11
        cy = d.getFullYear();
    } else {
        if (cy1 === undefined ) {	// if month defined but year not - define  year
            d = new Date();
            cy = d.getFullYear();
            cm = cm1;
        } else {
            cm = cm1;
            cy = cy1;
        }
    }

// Fill in the array of days
    var month = [];
    var week = [];
    var DAY=1;

// Store the first day into the array
    week = [0,0,0,0,0,0,0];
    var cdw = dayW(firstDay(cm,cy));
    if (cdw == 6) {						// creat a new week
        week[cdw] = 1;
        month.push(week);
        week = [0,0,0,0,0,0,0];
        cdw = 0;
    } else {
        week[cdw] = 1;
        cdw += 1;
    }
// Run till the end of the month
// if the week end, add an array and continue
    while (DAY < daysInMonth(cm, cy)) {
        DAY += 1;
        if (cdw <=6 ) {				// Fill in the week
            week[cdw] = DAY;
        } else {					// Add a new week
            month.push(week);
            week = [0,0,0,0,0,0,0];
            cdw = 0;
            week[cdw] = DAY;
        }
        cdw += 1;
    }
    month.push(week);				// Add the week to the month
    return month;					// a month array
}

// input: 	month array prepared using CalCreatData
//			divid - to show the month table
//			monthid - the month to calculate
function CalMonthShow(month,divid,monthid)
{
// Creating the table to show
// Add onclick for each cell
    str = "<table style='border:thin blue solid; width:300px'>";
    str +="<tr><td colspan='7' style='text-align:center'>"+mL[monthid-1]+"</td></tr>";	// use of the divid as the month
    str += "<tr><th>S</th><th>M</th><th>T</th><th>W</th><th>T</th><th>F</th><th>S</th></tr>";	// Header
    for (i1=0 ; i1 < month.length ; i1++) {
        str += '<tr>';
        for (i2=0 ; i2 < 7 ; i2++) {

            if (month[i1][i2] == 0) {
                str += '<td></td>'; // leave empty
            } else {
                // set date like MYSQL date - 2022-06-15
                var date = cy + '-' + to2( cm ) + '-' + to2( month[i1][i2] );
                str += '<td id="' + date + '" class="tdd" onclick="calenderClick(`' + date + '`)">' + month[i1][i2] + '</td>';
            }
        }
        str += '</tr>';
    }
    str += "</table>";
    $(divid).innerHTML += str;
}




