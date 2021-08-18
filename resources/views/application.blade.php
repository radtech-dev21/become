 <h2 class="box-title btn btn-lg font-16 btn-primary btn-block">Application Form</h2>
 <div class="row">
    <div class="col-md-6">
       <label for="first_name">First Name*</label>
       <input type="text" class="form-control" name="first_name" value="{{ old('first_name')??($application->contact_info)?$application->contact_info->first_name:$user->name }}" id="first_name" placeholder="First Name" required="">
       @if ($errors->has('first_name'))
       <span class="text-danger">{{ $errors->first('first_name') }}</span>
       @endif
    </div>
    <div class="col-md-6">
       <label for="last_name">Last Name*</label>
       <input type="last_name" class="form-control" name="last_name" value="{{ old('last_name')??($application->contact_info)?$application->contact_info->last_name:'' }}" id="last_name" placeholder="Last Name" required="">
       @if ($errors->has('last_name'))
       <span class="text-danger">{{ $errors->first('last_name') }}</span>
       @endif
    </div>
 </div>
 <div class="row">
    <div class="col-md-12">
       <label for="exampleInputEmail1">Email address*</label>
       <input type="email" class="form-control" name="email" value="{{ old('email')??($application->contact_info)?$application->contact_info->email:$user->email }}" id="exampleInputEmail1" placeholder="Enter email" required="">
       @if ($errors->has('email'))
       <span class="text-danger">{{ $errors->first('email') }}</span>
       @endif
    </div>
 </div>
 <div class="row">
    <div class="col-md-12">
       <label for="email2">Additional Email</label>
       <input type="email" class="form-control" name="email2" value="{{ old('email2')??($application->contact_info)?$application->contact_info->email2:'' }}" id="email2" placeholder="Additional Email">
       @if ($errors->has('email2'))
       <span class="text-danger">{{ $errors->first('email2') }}</span>
       @endif
    </div>
 </div>
 <div class="form-group">
    <label for="mobile_number">Mobile Number*</label>
    <input type="text" name="mobile_number" class="form-control" value="{{ old('mobile_number')??($application->contact_info)?$application->contact_info->mobile_number:'' }}" id="mobile_number" placeholder="Mobile Number" required="">
    @if ($errors->has('mobile_number'))
    <span class="text-danger">{{ $errors->first('mobile_number') }}</span>
    @endif
 </div>
 <div class="form-group">
    <label for="phone_number2">Phone Number 2 (optional)</label>
    <input type="text" name="mobile_number2" class="form-control" value="{{ old('mobile_number2')??($application->contact_info)?$application->contact_info->mobile_number2:'' }}"  id="phone_number2" placeholder="Phone Number 2">
    @if ($errors->has('mobile_number2'))
    <span class="text-danger">{{ $errors->first('mobile_number2') }}</span>
    @endif
 </div>
 <div class="form-group">
    <label for="dob">Birth Date</label>
    <input type="date" name="dob" class="form-control" value="{{ old('dob')??($application->contact_info)?$application->contact_info->dob:'' }}" id="birth_date" placeholder="birth_date">
    @if ($errors->has('birth_date'))
    <span class="text-danger">{{ $errors->first('birth_date') }}</span>
    @endif
 </div>
 <div class="form-group">
    <label for="home_address">Home Address</label>
    <input type="text" name="home_address" class="form-control"  id="home_address" value="{{ old('home_address')??($application->contact_info)?$application->contact_info->home_address:'' }}" placeholder="Address">
    @if ($errors->has('home_address'))
    <span class="text-danger">{{ $errors->first('home_address') }}</span>
    @endif
 </div>
 <div class="form-group">
    <label for="bussiness_address">Business Address</label>
    <input type="text" name="bussiness_address" class="form-control"  id="business_address" value="{{ old('bussiness_address')??($application->contact_info)?$application->contact_info->bussiness_address:'' }}" placeholder="Address">
    @if ($errors->has('bussiness_address'))
    <span class="text-danger">{{ $errors->first('bussiness_address') }}</span>
    @endif
 </div>
 <div class="form-group">
    <label for="state">Business Registration State</label>
    <select  class="form-control" id="state" name="state">
      <option value=""></option>
      @foreach($state_list as $k => $state)
      <option {{ ($user->state==$state)?"selected":"" }} value="{{$state}}">{{$state}}</option>
      @endforeach
    </select>
    @if ($errors->has('state'))
    <span class="text-danger">{{ $errors->first('state') }}</span>
    @endif
 </div>
 <!-- <div class="form-group">
    <label for="state">Business Registration State</label>
    <input type="text" name="state" class="form-control" value="{{ old('bussiness_address')??($application->contact_info)?$application->contact_info->bussiness_address:'' }}" id="state" placeholder="state" required="">
    @if ($errors->has('state'))
    <span class="text-danger">{{ $errors->first('state') }}</span>
    @endif
 </div> -->
 <!-- <h2 class="box-title btn btn-lg font-16 btn-primary btn-block">Additional Information</h2> -->
 <!-- <hr> -->
 <div class="row">
    <div class="col-md-6">
       <label for="ssn">Social Security Number</label>
       <input type="text" class="form-control" name="ssn" value="{{ old('bussiness_address')??($application->additional_info)?$application->additional_info->ssn:'' }}" id="ssn" placeholder="SSN" >
       @if ($errors->has('ssn'))
       <span class="text-danger">{{ $errors->first('ssn') }}</span>
       @endif
    </div>
    <div class="col-md-6">
       <label for="credit_score">Personal credit score</label>
       <input type="text" class="form-control" name="credit_score" value="{{ old('bussiness_address')??($application->additional_info)?$application->additional_info->credit_score:'' }}" id="credit_score" placeholder="Credit Score">
       @if ($errors->has('credit_score'))
       <span class="text-danger">{{ $errors->first('credit_score') }}</span>
       @endif
    </div>
 </div>
 <br>
 <!-- <h2 class="box-title btn btn-lg font-16 btn-primary btn-block">Business Information</h2> -->
 <hr>
 <div class="form-group">
    <label for="business_name">Legal Business Name</label>
    <input type="text" name="legal_name" class="form-control" value="{{ old('legal_name')??($application->bussiness_info)?$application->bussiness_info->legal_name:'' }}" id="business_name" placeholder="state">
    @if ($errors->has('legal_name'))
    <span class="text-danger">{{ $errors->first('legal_name') }}</span>
    @endif
 </div>
 <div class="form-group">
    <label for="trade_name">Trade Name</label>
    <input type="text" name="trade_name" class="form-control" value="{{ old('trade_name')??($application->bussiness_info)?$application->bussiness_info->trade_name:'' }}" id="trade_name" placeholder="Trade Name">
    @if ($errors->has('trade_name'))
    <span class="text-danger">{{ $errors->first('trade_name') }}</span>
    @endif
 </div>
 <div class="form-group">
    <label for="website">Business' Website</label>
    <input type="text" name="website" class="form-control" value="{{ old('website')??($application->bussiness_info)?$application->bussiness_info->website:'' }}" id="website" placeholder="Business' Website">
    @if ($errors->has('website'))
    <span class="text-danger">{{ $errors->first('website') }}</span>
    @endif
 </div>
 <div class="form-group">
    <label for="registration_date">Registration Date</label>
    <input type="date" name="registration_date" class="form-control" value="{{ old('registration_date')??($application->bussiness_info)?$application->bussiness_info->registration_date:'' }}" id="registration_date" placeholder="Registration Date">
    @if ($errors->has('registration_date'))
    <span class="text-danger">{{ $errors->first('registration_date') }}</span>
    @endif
 </div>
 <div class="row">
    <div class="col-md-12">
       <div class="form-group inner-addon right-addon">
          <label class="field-label">Are you the business owner?</label>
          <select class="form-control valid" name="is_owner" id="is_owner" data-msg-required="Please select an option from the list" aria-required="true" aria-invalid="false">
             <option {{ (old('registration_date')??($application->bussiness_info)?$application->bussiness_info->registration_date:'')=='0'?'selected':'' }} value="0">No</option>
             <option {{ (old('registration_date')??($application->bussiness_info)?$application->bussiness_info->registration_date:'')=='1'?'selected':'' }} value="1">Yes</option>
          </select>
          @if ($errors->has('is_owner'))
          <span class="text-danger">{{ $errors->first('is_owner') }}</span>
          @endif
       </div>
    </div>
 </div>
 <div class="row" id="business_owner_percentage">
    <div class="col-md-12">
       <div class="form-group inner-addon right-addon">
          <label class="field-label">What percentage of ownership do you have? (0-100%)</label>
          <input data-lpignore="true" data-hj-whitelist=""  data-rule-number="true" data-rule-minlength="1" data-rule-maxlength="3" data-msg="Please enter valid pecentages" type="number" value="{{ old('owner_percentage')??($application->bussiness_info)?$application->bussiness_info->owner_percentage:'60' }}" class="form-control numeric valid" name="owner_percentage" maxlength="3" aria-required="true" aria-invalid="false">
          @if ($errors->has('owner_percentage'))
          <span class="text-danger">{{ $errors->first('owner_percentage') }}</span>
          @endif
       </div>
       <div class="row">
          <div class="col-md-12">
             <div class="form-group inner-addon right-addon">
                <label class="field-label">Business Entity Type</label>
                <select class="form-control valid" data-address-element="1" data-field="legal_entity_type" name="entity_type"  aria-required="true" aria-invalid="false" >
                   <option {{ (old('entity_type')??($application->bussiness_info)?$application->bussiness_info->entity_type:'')==''?'selected':'' }} value=""></option>
                   <option {{ (old('entity_type')??($application->bussiness_info)?$application->bussiness_info->entity_type:'')=='Limited Liability Company'?'selected':'' }} value="Limited Liability Company">Limited Liability Company</option>
                   <option {{ (old('entity_type')??($application->bussiness_info)?$application->bussiness_info->entity_type:'')=='Sole proprietor'?'selected':'' }} value="Sole proprietor">Sole Proprietor</option>
                   <option {{ (old('entity_type')??($application->bussiness_info)?$application->bussiness_info->entity_type:'')=='Incorporation'?'selected':'' }} value="Incorporation">Incorporation</option>
                   <option {{ (old('entity_type')??($application->bussiness_info)?$application->bussiness_info->entity_type:'')=='Corporation'?'selected':'' }} value="Corporation">Corporation</option>
                   <option {{ (old('entity_type')??($application->bussiness_info)?$application->bussiness_info->entity_type:'')=='Trust'?'selected':'' }} value="Trust">Trust</option>
                   <option {{ (old('entity_type')??($application->bussiness_info)?$application->bussiness_info->entity_type:'')=='Partnership'?'selected':'' }} value="Partnership">Partnership</option>
                   <option {{ (old('entity_type')??($application->bussiness_info)?$application->bussiness_info->entity_type:'')=='Cooperation'?'selected':'' }} value="Cooperation">Cooperation</option>
                   <option {{ (old('entity_type')??($application->bussiness_info)?$application->bussiness_info->entity_type:'')=='Not For Profit'?'selected':'' }} value="Not for profit">Not For Profit</option>
                </select>
                @if ($errors->has('entity_type'))
                <span class="text-danger">{{ $errors->first('entity_type') }}</span>
                @endif
             </div>
          </div>
       </div>
       <div class="row">
          <div class="col-md-12">
             <div class="form-group inner-addon right-addon">
                <label class="field-label">Industry Type</label>
                <select id="industry_type" name="industry_type" class="form-control " data-msg-required="Please select industry type" title="Industry type"  aria-required="true">
                   <option value="">Select Industry</option>
                   <optgroup label="Automotive">
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Parts and Accessories'?'selected':'' }} value="Parts and Accessories">Parts and Accessories</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Dealership'?'selected':'' }} value="Dealership">Dealership</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Car Washes'?'selected':'' }} value="Car Washes">Car Washes</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Repair and Maintenance'?'selected':'' }}  value="Repair and Maintenance">Repair and Maintenance</option>
                   </optgroup>
                   <optgroup label="Construction">
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='New Construction (House Flipping)'?'selected':'' }} value="New Construction (House Flipping)">New Construction (House Flipping)</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Renovation & Remodeling'?'selected':'' }} value="Renovation & Remodeling">Renovation & Remodeling</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Commercial'?'selected':'' }} value="Commercial">Commercial</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Residential'?'selected':'' }} value="Residential">Residential</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='General Construction'?'selected':'' }} value="General Construction">General Construction</option>
                   </optgroup>
                   <optgroup label="Transportation, Taxis and Trucking">
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Freight Trucking'?'selected':'' }} value="Freight Trucking">Freight Trucking</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Limousine'?'selected':'' }} value="Limousine">Limousine</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Taxis'?'selected':'' }} value="Taxis">Taxis</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Travel Agencies'?'selected':'' }} value="Travel Agencies">Travel Agencies</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Other Transportation &amp; Travel'?'selected':'' }} value="Other Transportation &amp; Travel">Other Transportation &amp; Travel</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Car Rentals'?'selected':'' }} value="Car Rentals">Car Rentals</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Towing Services'?'selected':'' }} value="Towing Services">Towing Services</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Uber Driver'?'selected':'' }} value="Uber Driver">Uber Driver</option>
                   </optgroup>
                   <optgroup label="Retail Stores">
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Building Materials'?'selected':'' }} value="Building Materials">Building Materials</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Electronics'?'selected':'' }} value="Electronics">Electronics</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Fashion, Clothing, Sports Goods'?'selected':'' }} value="Fashion, Clothing, Sports Goods">Fashion, Clothing, Sports Goods</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Grocery, Supermarkets and Bakeries'?'selected':'' }} value="Grocery, Supermarkets and Bakeries">Grocery, Supermarkets and Bakeries</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Garden & Florists'?'selected':'' }} value="Garden & Florists">Garden & Florists</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Liquor Store'?'selected':'' }} value="Liquor Store">Liquor Store</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Other Retail Store'?'selected':'' }} value="Other Retail Store">Other Retail Store</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Cell Phone Store'?'selected':'' }} value="Cell Phone Store">Cell Phone Store</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Drug Paraphernalia'?'selected':'' }} value="Drug Paraphernalia">Drug Paraphernalia</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='E-Commerce'?'selected':'' }} value="E-Commerce">E-Commerce</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Electronic Cigarette Devices'?'selected':'' }}  value="Electronic Cigarette Devices">Electronic Cigarette Devices</option>
                   </optgroup>
                   <optgroup label="Entertainment and Recreation">
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Adult Entertainment'?'selected':'' }} value="Adult Entertainment">Adult Entertainment</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Gambling'?'selected':'' }} value="Gambling">Gambling</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Sports Club'?'selected':'' }} value="Sports Club">Sports Club</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Arts'?'selected':'' }} value="Arts">Arts</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Nightclubs'?'selected':'' }} value="Nightclubs">Nightclubs</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Event and Entertainment Sales'?'selected':'' }} value="Event and Entertainment Sales">Event and Entertainment Sales</option>
                   </optgroup>
                   <optgroup label="Utilities and Home Services">
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Cleaning'?'selected':'' }} value="Cleaning">Cleaning</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Plumbing, Electricians &amp; Hvac'?'selected':'' }} value="Plumbing, Electricians &amp; Hvac">Plumbing, Electricians &amp; Hvac</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Landscaping Services'?'selected':'' }} value="Landscaping Services">Landscaping Services</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Other Home Services'?'selected':'' }} value="Other Home Services">Other Home Services</option>
                   </optgroup>
                   <optgroup label="Retail Facilities">
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Beauty Salon & Barbers'?'selected':'' }} value="Beauty Salon & Barbers">Beauty Salon &amp; Barbers</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Dry Cleaning & Laundry'?'selected':'' }} value="Dry Cleaning & Laundry">Dry Cleaning &amp; Laundry</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Gym &amp; Fitness Center'?'selected':'' }} value="Gym &amp; Fitness Center">Gym &amp; Fitness Center</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Gym &amp; Fitness Center'?'selected':'' }} value="Nails Salon">Nails Salon</option>
                   </optgroup>
                   <optgroup label="Health Services">
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Dentists'?'selected':'' }} value="Dentists">Dentists</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Doctors Offices'?'selected':'' }} value="Doctors Offices">Doctors Offices</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Personal Care Services'?'selected':'' }} value="Personal Care Services">Personal Care Services</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Pharmacies and Drug Stores'?'selected':'' }} value="Pharmacies and Drug Stores">Pharmacies and Drug Stores</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Optometrists'?'selected':'' }} value="Optometrists">Optometrists</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Other Health Services'?'selected':'' }} value="38Other Health Services">Other Health Services</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Biotechnology'?'selected':'' }} value="Biotechnology">Biotechnology</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Diet Pills and Nutraceuticals'?'selected':'' }} value="Diet Pills and Nutraceuticals">Diet Pills and Nutraceuticals</option>
                   </optgroup>
                   <optgroup label="Hospitality">
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Hotels &amp; Inns'?'selected':'' }} value="Hotels &amp; Inns">Hotels &amp; Inns</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Bed and Breakfasts'?'selected':'' }} value="Bed and Breakfasts">Bed and Breakfasts</option>
                   </optgroup>
                   <optgroup label="Professional Services">
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Finance and Insurance'?'selected':'' }} value="Finance and Insurance">Finance and Insurance</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='It, Media, Or Publishing'?'selected':'' }} value="It, Media, Or Publishing">It, Media, Or Publishing</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Legal Services'?'selected':'' }} value="Legal Services">Legal Services</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Accounting'?'selected':'' }} value="Accounting">Accounting</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Call Centers'?'selected':'' }} value="Call Centers">Call Centers</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Communication Services'?'selected':'' }} value="Communication Services">Communication Services</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Registered Training Organization'?'selected':'' }} value="Registered Training Organization">Registered Training Organization</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Payday Or Any Other Financial Lenders'?'selected':'' }} value="Payday Or Any Other Financial Lenders">Payday Or Any Other Financial Lenders</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Direct Marketing'?'selected':'' }} value="Direct Marketing">Direct Marketing</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Forex Or Share Trading'?'selected':'' }} value="Forex Or Share Trading">Forex Or Share Trading</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Staffing and Recruiting'?'selected':'' }} value="Staffing and Recruiting">Staffing and Recruiting</option>
                   </optgroup>
                   <optgroup label="Restaurants and Food Services">
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Restaurants and Bars'?'selected':'' }} value="Restaurants and Bars">Restaurants and Bars</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Catering'?'selected':'' }} value="Catering">Catering</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Other Food Services'?'selected':'' }} value="Other Food Services">Other Food Services</option>
                   </optgroup>
                   <optgroup label="Other">
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Delivery Services'?'selected':'' }} value="Delivery Services">Delivery Services</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Warehouse and Storage'?'selected':'' }} value="Warehouse and Storage">Warehouse and Storage</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Security'?'selected':'' }} value="Security">Security</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Data Services'?'selected':'' }} value="Data Services">Data Services</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Funeral Services'?'selected':'' }} value="Funeral Services">Funeral Services</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Not For Profit'?'selected':'' }} value="Not For Profit">Not For Profit</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Firearm Sales'?'selected':'' }} value="Firearm Sales">Firearm Sales</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Agriculture, Forestry, Fishing and Hunting'?'selected':'' }} value="Agriculture, Forestry, Fishing and Hunting">Agriculture, Forestry, Fishing and Hunting</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Manufacturing'?'selected':'' }} value="Manufacturing">Manufacturing</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Mining (Except Oil and Gas)'?'selected':'' }} value="Mining (Except Oil and Gas)">Mining (Except Oil and Gas)</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Oil and Gas Extraction'?'selected':'' }} value="Oil and Gas Extraction">Oil and Gas Extraction</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Real Estate'?'selected':'' }} value="Real Estate">Real Estate</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Wholesale Trade'?'selected':'' }} value="Wholesale Trade">Wholesale Trade</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Convenience Stores'?'selected':'' }} value="Convenience Stores">Convenience Stores</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Gas Stations'?'selected':'' }} value="Gas Stations">Gas Stations</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Farming'?'selected':'' }} value="Farming">Farming</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Gas and Water Supply'?'selected':'' }} value="Gas and Water Supply">Gas and Water Supply</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Government and Defence'?'selected':'' }} value="Government and Defence">Government and Defence</option>
                      <option {{ (old('industry_type')??($application->bussiness_info)?$application->bussiness_info->industry_type:'')=='Auction Houses'?'selected':'' }} value="Auction Houses">Auction Houses</option>
                      <option value="16">Other</option>
                   </optgroup>
                </select>
                @if ($errors->has('industry_type'))
                <span class="text-danger">{{ $errors->first('industry_type') }}</span>
                @endif
             </div>
          </div>
       </div>
       <div class="row">
          <div class="col-md-12">
             <div class="form-group inner-addon right-addon">
                <label class="field-label">Who are your customers?</label>
                <select class="form-control valid" name="who_are_your_customers" id="who_are_your_customers" data-msg-required="Please select an option from the list"  aria-required="true" aria-invalid="false">
                   <option value=""></option>
                   <option {{ (old('who_are_your_customers')??($application->bussiness_info)?$application->bussiness_info->who_are_your_customers:'')=='Consumers'?'selected':'' }} value="Consumers">Consumers</option>
                   <option {{ (old('who_are_your_customers')??($application->bussiness_info)?$application->bussiness_info->who_are_your_customers:'')=='Businesses and Consumers'?'selected':'' }} value="Businesses and Consumers">Businesses and Consumers</option>
                   <option {{ (old('who_are_your_customers')??($application->bussiness_info)?$application->bussiness_info->who_are_your_customers:'')=='Large companies'?'selected':'' }} value="Large companies">Large companies</option>
                   <option {{ (old('who_are_your_customers')??($application->bussiness_info)?$application->bussiness_info->who_are_your_customers:'')=='Small businesses'?'selected':'' }} value="Small businesses">Small businesses</option>
                   <option {{ (old('who_are_your_customers')??($application->bussiness_info)?$application->bussiness_info->who_are_your_customers:'')=='Government'?'selected':'' }} value="Government">Government</option>
                   <option {{ (old('who_are_your_customers')??($application->bussiness_info)?$application->bussiness_info->who_are_your_customers:'')=='Businesses and Government'?'selected':'' }} value="Businesses and Government">Businesses and Government</option>
                </select>
                @if ($errors->has('who_are_your_customers'))
                <span class="text-danger">{{ $errors->first('who_are_your_customers') }}</span>
                @endif
             </div>
          </div>
       </div>
       <div class="row">
          <div class="col-md-12">
             <div class="form-group inner-addon right-addon">
                <label class="field-label">Number of Employees</label>
                <select class="form-control" name="number_of_employees" id="number_of_employees" data-msg-required="Please select an option from the list">
                   <option value=""></option>
                   <option {{ (old('number_of_employees')??($application->bussiness_info)?$application->bussiness_info->number_of_employees:'')=='0-10'?'selected':'' }} value="0-10">0 - 10 Employees</option>
                   <option {{ (old('number_of_employees')??($application->bussiness_info)?$application->bussiness_info->number_of_employees:'')=='10-25'?'selected':'' }} value="10-25">10 - 25 Employees</option>
                   <option {{ (old('number_of_employees')??($application->bussiness_info)?$application->bussiness_info->number_of_employees:'')=='25-50'?'selected':'' }} value="25-50">25 - 50 Employees</option>
                   <option {{ (old('number_of_employees')??($application->bussiness_info)?$application->bussiness_info->number_of_employees:'')=='50-100'?'selected':'' }} value="50-100">50 - 100 Employees</option>
                </select>
                @if ($errors->has('number_of_employees'))
                <span class="text-danger">{{ $errors->first('number_of_employees') }}</span>
                @endif
             </div>
          </div>
       </div>
       <div class="row">
          <div class="col-md-12">
             <div class="form-group inner-addon right-addon">
                <label class="field-label">Do You Have an E-Commerce (Online) Store? 
                   <small class="text-gray" style=" display: block; ">(for example Amazon, Shopify, Etsy)</small>
                </label>
                <div class="sell-online-radio-wrap">
                   <input {{ (old('is_store')??($application->bussiness_info)?$application->bussiness_info->is_store:'')=='0'?'checked':'' }} type="radio" name="is_store" value="0" id="sell-online-no">
                   <label for="sell-online-no">No
                   <input {{ (old('is_store')??($application->bussiness_info)?$application->bussiness_info->is_store:'')=='1'?'checked':'' }} type="radio" name="is_store" value="1" id="sell-online-yes"> 
                   <label for="sell-online-yes">Yes</label>
                </label>
                </div>
                @if ($errors->has('is_store'))
                <span class="text-danger">{{ $errors->first('is_store') }}</span>
                @endif
             </div>
          </div>
       </div>
       <div class="row">
          <div class="col-md-12">
             <div class="form-group inner-addon right-addon">
                <label class="field-label">What Payment Terms Do You Give Your Customers? </label>
                <select class="form-control" name="payment_your_customer" id="payment_your_customer" data-msg-required="Please select an option from the list" >
                   <option value=""></option>
                   <option {{ (old('payment_your_customer')??($application->bussiness_info)?$application->bussiness_info->payment_your_customer:'')=='immediate_payment'?'selected':'' }} value="immediate_payment">Immediate payment</option>
                   <option {{ (old('payment_your_customer')??($application->bussiness_info)?$application->bussiness_info->payment_your_customer:'')=='net_15'?'selected':'' }} value="net_15">Net 15</option>
                   <option {{ (old('payment_your_customer')??($application->bussiness_info)?$application->bussiness_info->payment_your_customer:'')=='net_30'?'selected':'' }} value="net_30">Net 30</option>
                   <option {{ (old('payment_your_customer')??($application->bussiness_info)?$application->bussiness_info->payment_your_customer:'')=='net_60'?'selected':'' }} value="net_60">Net 60</option>
                   <option {{ (old('payment_your_customer')??($application->bussiness_info)?$application->bussiness_info->payment_your_customer:'')=='net_90'?'selected':'' }} value="net_90">Net 90 or over</option>
                   <option {{ (old('payment_your_customer')??($application->bussiness_info)?$application->bussiness_info->payment_your_customer:'')=='not_sure'?'selected':'' }} value="not_sure">I'm not sure</option>
                </select>
                 @if ($errors->has('payment_your_customer'))
                   <span class="text-danger">{{ $errors->first('payment_your_customer') }}</span>
                @endif
             </div>
          </div>
       </div>
    </div>
 </div>
 <h2 class="box-title btn btn-lg font-16 btn-primary btn-block">Secretary of State Data</h2>
 <hr>
 <div class="row">
    <div class="col-md-12">
       <div class="form-group inner-addon right-addon">
          <label class="field-label">Entity Name</label>
          <input title="Entity Name" type="text" value="{{ old('entity_name2')??($application->bussiness_info)?$application->bussiness_info->entity_name2:''}}" class="form-control" name="entity_name2">
          @if ($errors->has('entity_name2'))
             <span class="text-danger">{{ $errors->first('entity_name2') }}</span>
          @endif
       </div>
    </div>
 </div>
 <div class="row">
    <div class="col-md-12">
       <div class="form-group inner-addon right-addon">
          <label class="field-label">Company Number</label>
          <input data-lpignore="true" data-hj-whitelist="" type="tel" value="112572C5" class="form-control valid" name="company_number" aria-invalid="false">
          @if ($errors->has('company_number'))
             <span class="text-danger">{{ $errors->first('company_number') }}</span>
          @endif
       </div>
    </div>
 </div>
 <div class="row">
    <div class="col-md-12">
       <div class="form-group inner-addon right-addon">
          <label class="field-label">Registration Date</label>
          <input title="Business ID" type="text" value="2013-12-27" disabled="" class="form-control" name="incorporation_date">
          @if ($errors->has('incorporation_date'))
             <span class="text-danger">{{ $errors->first('incorporation_date') }}</span>
          @endif
       </div>
    </div>
 </div>
 <div class="row">
    <div class="col-md-12">
       <div class="form-group inner-addon right-addon">
          <label class="field-label">Status</label>
          <input title="Business ID" type="text" value="Adm. Terminated" disabled="" class="form-control" name="current_status">
       </div>
    </div>
 </div>
 <h2 class="box-title btn btn-lg font-16 btn-primary btn-block">Loan Information</h2>
 <hr>
 <div class="row">
    <div class="col-md-12">
       <div class="form-group inner-addon right-addon">
          <label class="field-label">Requested Loan Amount</label>
          <i class="fa fa-dollar-sign" aria-hidden="true"></i>
          <input data-lpignore="true" data-msg-range="Please enter a numeric value between 5,000 and 500,000" data-rule-range="5000,500000" data-hj-whitelist="" title="Loan requested" data-msg-required="Please enter a numeric value for requested loan amount" type="tel" value="{{ old('entity_name2')??($application->requested_loan_amount)?$application->requested_loan_amount:''}}"  class="form-control numeric valid" name="requested_loan_amount" >
          @if ($errors->has('requested_loan_amount'))
             <span class="text-danger">{{ $errors->first('requested_loan_amount') }}</span>
          @endif
       </div>
    </div>
 </div>
 <div class="row">
    <div class="col-md-12">
       <div class="form-group inner-addon right-addon">
          <label class="field-label">When do you need the money?</label>
          <select title="How soon do you need the money?"  class="form-control valid" data-msg-required="Please select an option from the list" name="when_need_money" aria-required="true" aria-invalid="false">
             <option value=""></option>
             <option {{ (old('when_need_money')??($application->bussiness_info)?$application->when_need_money:'')=='Immediately'?'selected':'' }} value="Immediately">Immediately</option>
             <option {{ (old('when_need_money')??($application->bussiness_info)?$application->when_need_money:'')=='1-2 Weeks'?'selected':'' }} value="1-2 Weeks">1-2 Weeks</option>
             <option {{ (old('when_need_money')??($application->bussiness_info)?$application->when_need_money:'')=='30 Days'?'selected':'' }} value="30 Days">30 Days</option>
             <option {{ (old('when_need_money')??($application->bussiness_info)?$application->when_need_money:'')=='More than 30 days'?'selected':'' }} value="More than 30 days">More than 30 days</option>
          </select>
          @if ($errors->has('when_need_money'))
             <span class="text-danger">{{ $errors->first('when_need_money') }}</span>
          @endif
       </div>
    </div>
 </div>
 <div class="row">
    <div class="col-md-12">
       <div class="form-group inner-addon right-addon">
          <label class="field-label">Which is most important to you?</label>
          <select title="Which is most important to you?"  class="form-control valid" data-msg-required="Please select an option from the list" name="terms" aria-required="true" aria-invalid="false" >
             <option value=""></option>
             <option {{ (old('terms')??($application->bussiness_info)?$application->terms:'')=='short_loan_term'?'selected':'' }} value="short_loan_term">Short loan term</option>
             <option {{ (old('terms')??($application->bussiness_info)?$application->terms:'')=='Low interest rate'?'selected':'' }} value="Low interest rate">Low interest rate</option>
             <option {{ (old('terms')??($application->bussiness_info)?$application->terms:'')=='Long loan term'?'selected':'' }} value="Long loan term">Long loan term</option>
             <option {{ (old('terms')??($application->bussiness_info)?$application->terms:'')=='Fast access to funds'?'selected':'' }} value="Fast access to funds">Fast access to funds</option>
          </select>
          @if ($errors->has('terms'))
             <span class="text-danger">{{ $errors->first('terms') }}</span>
          @endif
       </div>
    </div>
 </div>
 <div class="row">
    <div class="col-md-12">
       <div class="form-group inner-addon right-addon">
          <label class="field-label">What Do You Need the Money For?</label>
          <select title="How soon do you need the money?" class="form-control valid" data-msg-required="Please select an option from the list" name="money_for" aria-invalid="false" >
             <option value=""></option>
             <option {{ (old('money_for')??($application->bussiness_info)?$application->money_for:'')=='Expand your business'?'selected':'' }} value="Expand your business">Expand your business</option>
             <option {{ (old('money_for')??($application->bussiness_info)?$application->money_for:'')=='Promote your business'?'selected':'' }} value="Promote your business">Promote your business</option>
             <option {{ (old('money_for')??($application->bussiness_info)?$application->money_for:'')=='Improve cash flow'?'selected':'' }} value="Improve cash flow">Improve cash flow</option>
             <option {{ (old('money_for')??($application->bussiness_info)?$application->money_for:'')=='Refinance an Existing Loan'?'selected':'' }} value="Refinance an Existing Loan">Refinance an Existing Loan</option>
             <option {{ (old('money_for')??($application->bussiness_info)?$application->money_for:'')=='Pay taxes'?'selected':'' }} value="Pay taxes">Pay taxes</option>
             <option {{ (old('money_for')??($application->bussiness_info)?$application->money_for:'')=='Purchase a Vehicle'?'selected':'' }} value="Purchase a Vehicle">Purchase a Vehicle</option>
             <option {{ (old('money_for')??($application->bussiness_info)?$application->money_for:'')=='Purchase Property'?'selected':'' }} value="Purchase Property">Purchase Property</option>
             <option {{ (old('money_for')??($application->bussiness_info)?$application->money_for:'')=='Purchase Equipment'?'selected':'' }} value="Purchase Equipment">Purchase Equipment</option>
             <option {{ (old('money_for')??($application->bussiness_info)?$application->money_for:'')=='Purchase inventory'?'selected':'' }} value="Purchase inventory">Purchase inventory</option>
             <option {{ (old('money_for')??($application->bussiness_info)?$application->money_for:'')=='Remodel an Existing Location'?'selected':'' }} value="Remodel an Existing Location">Remodel an Existing Location</option>
             <option {{ (old('money_for')??($application->bussiness_info)?$application->money_for:'')=='Import goods'?'selected':'' }} value="Import goods">Import goods</option>
             <option {{ (old('money_for')??($application->bussiness_info)?$application->money_for:'')=='Other (Please specify)'?'selected':'' }} value="Other (Please specify)">Other (Please specify)</option>
          </select>
          @if ($errors->has('money_for'))
             <span class="text-danger">{{ $errors->first('money_for') }}</span>
          @endif
       </div>
    </div>
 </div>
 <div class="row consent>">
    <div class="col-md-12" style="font-size:12px;">
       <h5>Permission to Forward Your Application</h5>

       By clicking 'Save', I authorize Borrowble LLC. to forward my application to third party <a target="_blank" href="https://www.become.co/blog/us-lenders/" style="color:#333;text-decoration:underline">partners and lenders ("Assignee's")</a>. I authorize Borrowble and its Assignee's to obtain consumer and commercial credit reports and any additional related information from external sources, including consumer reporting agencies, to evaluate my application. I acknowledge and authorize these Assignee's to use the contact information in my application in order to contact me, including by marketing calls or texts (which may be made by automated or pre-recorded voice) regarding the loan application. Telephone calls may be recorded. This consent is not a condition to receiving the service and can be revoked by opting out, as described in Borrowble's privacy policy. I acknowledge that partners may perform a "soft" credit check as part of assessing my application. Furthermore, I hereby waive and release any claims against Borrowble, all Assignee's, and any information‐providers arising from any act or omission relating to the requesting, receiving or release of the information obtained in connection with this application.
    </div>
 </div>
 <div class="row consent">
    <div class="col-md-12 form-group">
       <label for="disclaimer_confirmed_chk"><input name="disclaimer_confirmed_chk" required="" data-msg-required="Please read and accept our terms &amp; conditions." checked="" style="width: 18px;height: 18px;position: relative;top: 4px;" type="checkbox" id="disclaimer_confirmed_chk" aria-required="true"> I agree to these terms</label>
    </div>
 </div>
 <div class="row save-button-wrap">
    <div class="col-md-12 text-center"><button style="margin-top:40px;margin-bottom:40px;" id="submit-online-application" class=" btn btn-primary btn-shadow btn-lg hvr-icon-wobble-vertical" type="submit"> Save Application <i class="fas fa-save hvr-icon" aria-hidden="true"></i></button> </div>
 </div>
