#TEST CASES

##SIGN UP

1. Valid case: all fields entered properly and user was redirected to /cabinet
2. User didn't fill one of the required fields: Show error message and return back on sign up page
3. User entered not valid email: Show error message and return back on sign up page

##SIGN IN
1. Valid case: email and password entered correctly and current user exists in DB
2. User didn't fill one of the require fields: Return back and show error message
3. User already logged in and trying to log again: Redirect to /cabinet and show "information" message
4. User wasn't redirected to /cabinet

##SEND REQUEST BE A FRIEND
1. User1 sends request to be a friend to User2. User2 see message.
2. User1 sends request to be a friend to User2, but User2 is not logged in. Notification sends to User2 on email

##ADD STATUS

##CONFIRM REQUEST TO FRIEND
1. User1 sends request to be a friend to User2. User2 confirms request.

##REMOVE USER FROM A LIST OF FRIENDS
1. User2 removes User1 from a list of friends.

##SEARCH
1. Check whether the blank space is trimmed on starting of the first word in the text box
2. Searched username wasn't found: show message  
3. Submited blank search field: show message 
4. Check the total number of results

##UPDATE PROFILE
1. Valid Case: Fill First name, Last name, Location
2. Numbers were added to first name and last name: return back to form and show error message
3. Empty field was submitted: redirected back and highline those field