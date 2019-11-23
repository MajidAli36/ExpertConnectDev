@extends('user.userProfileLayout')
@section('userProfileContent')
<div class="wrapper">
<div class="content">
   <div class="inner profile-edit">
      <div class="profile-data">
         <div class="profile-menu">
            <h2>Settings</h2>
            <ul>
               <li><a href="profile.html" class="active"><span></span>My Profile</a></li>
               <li><a href=""><span></span>Payment methods</a></li>
               <li><a href="email-and-password.html"><span></span>Email and password</a></li>
               <li><a href=""><span></span>Connect accounts</a></li>
               <li><a href="phone-verification.html"><span></span>Phone verification</a></li>
            </ul>
            <a href="profile.html" class="view-btn">View Pofile</a>
         </div>
         <div class="profile-content content-view">
            <h3>My Profile</h3>
            <div class="profile-info">
               <div class="profile-img"><img src="img/profile.jpg" alt=""></div>
               <div class="profile-name">
                  <strong>John Smith</strong>
                  <span>Miami, Florida</span>
               </div>
            </div>
            <div class="fields name">
               <label>Name</label>
               <input type="text" placeholder="John Smith">
            </div>
            <div class="fields fields-edit gender">
               <label>Gender</label>
               <div class="female">
                  <input id="gender-female" type="radio" name="gender" value="Female">
                  <label for="gender-female"><span class="checkmark"></span>Female</label>
               </div>
               <div class="male">
                  <input id="gender-male" type="radio" name="gender" value="Male">
                  <label for="gender-male"><span class="checkmark"></span>Male</label>
               </div>
            </div>
            <div class="fields">
               <label>About me</label>
               <textarea name="" id="" cols="30" rows="10"></textarea>
            </div>
            <h4>Private details <span>Only visible for you</span></h4>
            <div class="fields">
               <label>Street</label>
               <input type="text" placeholder="">
            </div>
            <div class="fields">
               <label>Country</label>
               <input type="text" placeholder="United States">
            </div>
            <div class="fields">
               <label>State</label>
               <input type="text" placeholder="Florida">
            </div>
            <div class="fields">
               <label>Country</label>
               <input type="text" placeholder="United States">
            </div>
            <div class="fields">
               <label>City</label>
               <div class="fields-item city">
                  <div class="select-box">
                     <select name="" id="">
                        <option value="">Miami</option>
                        <option value="">Miami</option>
                     </select>
                  </div>
               </div>
               <div class="fields-item zipcode">
                  <input type="text" placeholder="33139">
               </div>
            </div>
            <div class="fields birthday">
               <label>Birthday</label>
               <div class="fields-item year">
                  <div class="select-box">
                     <select name="" id="">
                        <option value="">YY</option>
                        <option value="">1992</option>
                        <option value="">1991</option>
                     </select>
                  </div>
               </div>
               <div class="fields-item month">
                  <div class="select-box">
                     <select name="" id="">
                        <option value="">MM</option>
                        <option value="">Jan</option>
                        <option value="">Feb</option>
                     </select>
                  </div>
               </div>
               <div class="fields-item day">
                  <div class="select-box">
                     <select name="" id="">
                        <option value="">DD</option>
                        <option value="">01</option>
                        <option value="">02</option>
                     </select>
                  </div>
               </div>
            </div>
            <button>Save</button>
         </div>
      </div>
   </div>
</div>
</div>
@endsection