@if ($taggable!=null)

    @php
        $tags = $taggable->tags();
    @endphp

    <div class="mt-3 mb-5">
        <label class="form-label">Select Tags or Enter a New Tag</label>
        <select id="{{$control_id}}" name="{{$control_id}}[]" class="form-control" style="width: 100%" placeholder="Select a Tag" multiple="multiple">
        
            <option value="United States" selected="" data-select2-id="14">United States</option>
            <option value="United Kingdom" selected="" data-select2-id="15">United Kingdom</option>
            <option value="Afghanistan" selected="" data-select2-id="16">Afghanistan</option>
            <option value="Aland Islands" data-select2-id="29">Aland Islands</option>
            <option value="Albania" data-select2-id="30">Albania</option>
            <option value="Algeria" data-select2-id="31">Algeria</option>
            <option value="American Samoa" data-select2-id="32">American Samoa</option>
            <option value="Andorra" data-select2-id="33">Andorra</option>
            <option value="Angola" data-select2-id="34">Angola</option>
            <option value="Anguilla" data-select2-id="35">Anguilla</option>
            <option value="Antarctica" data-select2-id="36">Antarctica</option>
            <option value="Antigua and Barbuda" data-select2-id="37">Antigua and Barbuda</option>
            <option value="Argentina" data-select2-id="38">Argentina</option>
            <option value="Armenia" data-select2-id="39">Armenia</option>
            <option value="Aruba" data-select2-id="40">Aruba</option>
            <option value="Australia" data-select2-id="41">Australia</option>
            <option value="Austria" data-select2-id="42">Austria</option>
            <option value="Azerbaijan" data-select2-id="43">Azerbaijan</option>
            <option value="Bahamas" data-select2-id="44">Bahamas</option>
            <option value="Bahrain" data-select2-id="45">Bahrain</option>
            <option value="Bangladesh" data-select2-id="46">Bangladesh</option>
            <option value="Barbados" data-select2-id="47">Barbados</option>
            <option value="Belarus" data-select2-id="48">Belarus</option>
            <option value="Belgium" data-select2-id="49">Belgium</option>
            <option value="Belize" data-select2-id="50">Belize</option>
            <option value="Benin" data-select2-id="51">Benin</option>
            <option value="Bermuda" data-select2-id="52">Bermuda</option>
            <option value="Bhutan" data-select2-id="53">Bhutan</option>
            <option value="Bolivia, Plurinational State of" data-select2-id="54">Bolivia, Plurinational State of</option>
            <option value="Bonaire, Sint Eustatius and Saba" data-select2-id="55">Bonaire, Sint Eustatius and Saba</option>
            <option value="Bosnia and Herzegovina" data-select2-id="56">Bosnia and Herzegovina</option>
            <option value="Botswana" data-select2-id="57">Botswana</option>
            <option value="Bouvet Island" data-select2-id="58">Bouvet Island</option>
            <option value="Brazil" data-select2-id="59">Brazil</option>
            <option value="British Indian Ocean Territory" data-select2-id="60">British Indian Ocean Territory</option>
            <option value="Brunei Darussalam" data-select2-id="61">Brunei Darussalam</option>
            <option value="Bulgaria" data-select2-id="62">Bulgaria</option>
            <option value="Burkina Faso" data-select2-id="63">Burkina Faso</option>
            <option value="Burundi" data-select2-id="64">Burundi</option>
            <option value="Cambodia" data-select2-id="65">Cambodia</option>
            <option value="Cameroon" data-select2-id="66">Cameroon</option>
            <option value="Canada" data-select2-id="67">Canada</option>
            <option value="Cape Verde" data-select2-id="68">Cape Verde</option>
            <option value="Cayman Islands" data-select2-id="69">Cayman Islands</option>
            <option value="Central African Republic" data-select2-id="70">Central African Republic</option>
            <option value="Chad" data-select2-id="71">Chad</option>
            <option value="Chile" data-select2-id="72">Chile</option>
            <option value="China" data-select2-id="73">China</option>
            <option value="Christmas Island" data-select2-id="74">Christmas Island</option>
            <option value="Cocos (Keeling) Islands" data-select2-id="75">Cocos (Keeling) Islands</option>
            <option value="Colombia" data-select2-id="76">Colombia</option>
            <option value="Comoros" data-select2-id="77">Comoros</option>
            <option value="Congo" data-select2-id="78">Congo</option>
            <option value="Congo, The Democratic Republic of The" data-select2-id="79">Congo, The Democratic Republic of The</option>
            <option value="Cook Islands" data-select2-id="80">Cook Islands</option>
            <option value="Costa Rica" data-select2-id="81">Costa Rica</option>
            <option value="Cote D'ivoire" data-select2-id="82">Cote D'ivoire</option>
            <option value="Croatia" data-select2-id="83">Croatia</option>
            <option value="Cuba" data-select2-id="84">Cuba</option>
            <option value="Curacao" data-select2-id="85">Curacao</option>
            <option value="Cyprus" data-select2-id="86">Cyprus</option>
            <option value="Czech Republic" data-select2-id="87">Czech Republic</option>
            <option value="Denmark" data-select2-id="88">Denmark</option>
            <option value="Djibouti" data-select2-id="89">Djibouti</option>
            <option value="Dominica" data-select2-id="90">Dominica</option>
            <option value="Dominican Republic" data-select2-id="91">Dominican Republic</option>
            <option value="Ecuador" data-select2-id="92">Ecuador</option>
            <option value="Egypt" data-select2-id="93">Egypt</option>
            <option value="El Salvador" data-select2-id="94">El Salvador</option>
            <option value="Equatorial Guinea" data-select2-id="95">Equatorial Guinea</option>
            <option value="Eritrea" data-select2-id="96">Eritrea</option>
            <option value="Estonia" data-select2-id="97">Estonia</option>
            <option value="Ethiopia" data-select2-id="98">Ethiopia</option>
            <option value="Falkland Islands (Malvinas)" data-select2-id="99">Falkland Islands (Malvinas)</option>
            <option value="Faroe Islands" data-select2-id="100">Faroe Islands</option>
            <option value="Fiji" data-select2-id="101">Fiji</option>
            <option value="Finland" data-select2-id="102">Finland</option>
            <option value="France" data-select2-id="103">France</option>
            <option value="French Guiana" data-select2-id="104">French Guiana</option>
            <option value="French Polynesia" data-select2-id="105">French Polynesia</option>
            <option value="French Southern Territories" data-select2-id="106">French Southern Territories</option>
            <option value="Gabon" data-select2-id="107">Gabon</option>
            <option value="Gambia" data-select2-id="108">Gambia</option>
            <option value="Georgia" data-select2-id="109">Georgia</option>
            <option value="Germany" data-select2-id="110">Germany</option>
            <option value="Ghana" data-select2-id="111">Ghana</option>
            <option value="Gibraltar" data-select2-id="112">Gibraltar</option>
            <option value="Greece" data-select2-id="113">Greece</option>
            <option value="Greenland" data-select2-id="114">Greenland</option>
            <option value="Grenada" data-select2-id="115">Grenada</option>
            <option value="Guadeloupe" data-select2-id="116">Guadeloupe</option>
            <option value="Guam" data-select2-id="117">Guam</option>
            <option value="Guatemala" data-select2-id="118">Guatemala</option>
            <option value="Guernsey" data-select2-id="119">Guernsey</option>
            <option value="Guinea" data-select2-id="120">Guinea</option>
            <option value="Guinea-bissau" data-select2-id="121">Guinea-bissau</option>
            <option value="Guyana" data-select2-id="122">Guyana</option>
            <option value="Haiti" data-select2-id="123">Haiti</option>
            <option value="Heard Island and Mcdonald Islands" data-select2-id="124">Heard Island and Mcdonald Islands</option>
            <option value="Holy See (Vatican City State)" data-select2-id="125">Holy See (Vatican City State)</option>
            <option value="Honduras" data-select2-id="126">Honduras</option>
            <option value="Hong Kong" data-select2-id="127">Hong Kong</option>
            <option value="Hungary" data-select2-id="128">Hungary</option>
            <option value="Iceland" data-select2-id="129">Iceland</option>
            <option value="India" data-select2-id="130">India</option>
            <option value="Indonesia" data-select2-id="131">Indonesia</option>
            <option value="Iran, Islamic Republic of" data-select2-id="132">Iran, Islamic Republic of</option>
            <option value="Iraq" data-select2-id="133">Iraq</option>
            <option value="Ireland" data-select2-id="134">Ireland</option>
            <option value="Isle of Man" data-select2-id="135">Isle of Man</option>
            <option value="Israel" data-select2-id="136">Israel</option>
            <option value="Italy" data-select2-id="137">Italy</option>
            <option value="Jamaica" data-select2-id="138">Jamaica</option>
            <option value="Japan" data-select2-id="139">Japan</option>
            <option value="Jersey" data-select2-id="140">Jersey</option>
            <option value="Jordan" data-select2-id="141">Jordan</option>
            <option value="Kazakhstan" data-select2-id="142">Kazakhstan</option>
            <option value="Kenya" data-select2-id="143">Kenya</option>
            <option value="Kiribati" data-select2-id="144">Kiribati</option>
            <option value="Korea, Democratic People's Republic of" data-select2-id="145">Korea, Democratic People's Republic of</option>
            <option value="Korea, Republic of" data-select2-id="146">Korea, Republic of</option>
            <option value="Kuwait" data-select2-id="147">Kuwait</option>
            <option value="Kyrgyzstan" data-select2-id="148">Kyrgyzstan</option>
            <option value="Lao People's Democratic Republic" data-select2-id="149">Lao People's Democratic Republic</option>
            <option value="Latvia" data-select2-id="150">Latvia</option>
            <option value="Lebanon" data-select2-id="151">Lebanon</option>
            <option value="Lesotho" data-select2-id="152">Lesotho</option>
            <option value="Liberia" data-select2-id="153">Liberia</option>
            <option value="Libya" data-select2-id="154">Libya</option>
            <option value="Liechtenstein" data-select2-id="155">Liechtenstein</option>
            <option value="Lithuania" data-select2-id="156">Lithuania</option>
            <option value="Luxembourg" data-select2-id="157">Luxembourg</option>
            <option value="Macao" data-select2-id="158">Macao</option>
            <option value="Macedonia, The Former Yugoslav Republic of" data-select2-id="159">Macedonia, The Former Yugoslav Republic of</option>
            <option value="Madagascar" data-select2-id="160">Madagascar</option>
            <option value="Malawi" data-select2-id="161">Malawi</option>
            <option value="Malaysia" data-select2-id="162">Malaysia</option>
            <option value="Maldives" data-select2-id="163">Maldives</option>
            <option value="Mali" data-select2-id="164">Mali</option>
            <option value="Malta" data-select2-id="165">Malta</option>
            <option value="Marshall Islands" data-select2-id="166">Marshall Islands</option>
            <option value="Martinique" data-select2-id="167">Martinique</option>
            <option value="Mauritania" data-select2-id="168">Mauritania</option>
            <option value="Mauritius" data-select2-id="169">Mauritius</option>
            <option value="Mayotte" data-select2-id="170">Mayotte</option>
            <option value="Mexico" data-select2-id="171">Mexico</option>
            <option value="Micronesia, Federated States of" data-select2-id="172">Micronesia, Federated States of</option>
            <option value="Moldova, Republic of" data-select2-id="173">Moldova, Republic of</option>
            <option value="Monaco" data-select2-id="174">Monaco</option>
            <option value="Mongolia" data-select2-id="175">Mongolia</option>
            <option value="Montenegro" data-select2-id="176">Montenegro</option>
            <option value="Montserrat" data-select2-id="177">Montserrat</option>
            <option value="Morocco" data-select2-id="178">Morocco</option>
            <option value="Mozambique" data-select2-id="179">Mozambique</option>
            <option value="Myanmar" data-select2-id="180">Myanmar</option>
            <option value="Namibia" data-select2-id="181">Namibia</option>
            <option value="Nauru" data-select2-id="182">Nauru</option>
            <option value="Nepal" data-select2-id="183">Nepal</option>
            <option value="Netherlands" data-select2-id="184">Netherlands</option>
            <option value="New Caledonia" data-select2-id="185">New Caledonia</option>
            <option value="New Zealand" data-select2-id="186">New Zealand</option>
            <option value="Nicaragua" data-select2-id="187">Nicaragua</option>
            <option value="Niger" data-select2-id="188">Niger</option>
            <option value="Nigeria" data-select2-id="189">Nigeria</option>
            <option value="Niue" data-select2-id="190">Niue</option>
            <option value="Norfolk Island" data-select2-id="191">Norfolk Island</option>
            <option value="Northern Mariana Islands" data-select2-id="192">Northern Mariana Islands</option>
            <option value="Norway" data-select2-id="193">Norway</option>
            <option value="Oman" data-select2-id="194">Oman</option>
            <option value="Pakistan" data-select2-id="195">Pakistan</option>
            <option value="Palau" data-select2-id="196">Palau</option>
            <option value="Palestinian Territory, Occupied" data-select2-id="197">Palestinian Territory, Occupied</option>
            <option value="Panama" data-select2-id="198">Panama</option>
            <option value="Papua New Guinea" data-select2-id="199">Papua New Guinea</option>
            <option value="Paraguay" data-select2-id="200">Paraguay</option>
            <option value="Peru" data-select2-id="201">Peru</option>
            <option value="Philippines" data-select2-id="202">Philippines</option>
            <option value="Pitcairn" data-select2-id="203">Pitcairn</option>
            <option value="Poland" data-select2-id="204">Poland</option>
            <option value="Portugal" data-select2-id="205">Portugal</option>
            <option value="Puerto Rico" data-select2-id="206">Puerto Rico</option>
            <option value="Qatar" data-select2-id="207">Qatar</option>
            <option value="Reunion" data-select2-id="208">Reunion</option>
            <option value="Romania" data-select2-id="209">Romania</option>
            <option value="Russian Federation" data-select2-id="210">Russian Federation</option>
            <option value="Rwanda" data-select2-id="211">Rwanda</option>
            <option value="Saint Barthelemy" data-select2-id="212">Saint Barthelemy</option>
            <option value="Saint Helena, Ascension and Tristan da Cunha" data-select2-id="213">Saint Helena, Ascension and Tristan da Cunha</option>
            <option value="Saint Kitts and Nevis" data-select2-id="214">Saint Kitts and Nevis</option>
            <option value="Saint Lucia" data-select2-id="215">Saint Lucia</option>
            <option value="Saint Martin (French part)" data-select2-id="216">Saint Martin (French part)</option>
            <option value="Saint Pierre and Miquelon" data-select2-id="217">Saint Pierre and Miquelon</option>
            <option value="Saint Vincent and The Grenadines" data-select2-id="218">Saint Vincent and The Grenadines</option>
            <option value="Samoa" data-select2-id="219">Samoa</option>
            <option value="San Marino" data-select2-id="220">San Marino</option>
            <option value="Sao Tome and Principe" data-select2-id="221">Sao Tome and Principe</option>
            <option value="Saudi Arabia" data-select2-id="222">Saudi Arabia</option>
            <option value="Senegal" data-select2-id="223">Senegal</option>
            <option value="Serbia" data-select2-id="224">Serbia</option>
            <option value="Seychelles" data-select2-id="225">Seychelles</option>
            <option value="Sierra Leone" data-select2-id="226">Sierra Leone</option>
            <option value="Singapore" data-select2-id="227">Singapore</option>
            <option value="Sint Maarten (Dutch part)" data-select2-id="228">Sint Maarten (Dutch part)</option>
            <option value="Slovakia" data-select2-id="229">Slovakia</option>
            <option value="Slovenia" data-select2-id="230">Slovenia</option>
            <option value="Solomon Islands" data-select2-id="231">Solomon Islands</option>
            <option value="Somalia" data-select2-id="232">Somalia</option>
            <option value="South Africa" data-select2-id="233">South Africa</option>
            <option value="South Georgia and The South Sandwich Islands" data-select2-id="234">South Georgia and The South Sandwich Islands</option>
            <option value="South Sudan" data-select2-id="235">South Sudan</option>
            <option value="Spain" data-select2-id="236">Spain</option>
            <option value="Sri Lanka" data-select2-id="237">Sri Lanka</option>
            <option value="Sudan" data-select2-id="238">Sudan</option>
            <option value="Suriname" data-select2-id="239">Suriname</option>
            <option value="Svalbard and Jan Mayen" data-select2-id="240">Svalbard and Jan Mayen</option>
            <option value="Swaziland" data-select2-id="241">Swaziland</option>
            <option value="Sweden" data-select2-id="242">Sweden</option>
            <option value="Switzerland" data-select2-id="243">Switzerland</option>
            <option value="Syrian Arab Republic" data-select2-id="244">Syrian Arab Republic</option>
            <option value="Taiwan, Province of China" data-select2-id="245">Taiwan, Province of China</option>
            <option value="Tajikistan" data-select2-id="246">Tajikistan</option>
            <option value="Tanzania, United Republic of" data-select2-id="247">Tanzania, United Republic of</option>
            <option value="Thailand" data-select2-id="248">Thailand</option>
            <option value="Timor-leste" data-select2-id="249">Timor-leste</option>
            <option value="Togo" data-select2-id="250">Togo</option>
            <option value="Tokelau" data-select2-id="251">Tokelau</option>
            <option value="Tonga" data-select2-id="252">Tonga</option>
            <option value="Trinidad and Tobago" data-select2-id="253">Trinidad and Tobago</option>
            <option value="Tunisia" data-select2-id="254">Tunisia</option>
            <option value="Turkey" data-select2-id="255">Turkey</option>
            <option value="Turkmenistan" data-select2-id="256">Turkmenistan</option>
            <option value="Turks and Caicos Islands" data-select2-id="257">Turks and Caicos Islands</option>
            <option value="Tuvalu" data-select2-id="258">Tuvalu</option>
            <option value="Uganda" data-select2-id="259">Uganda</option>
            <option value="Ukraine" data-select2-id="260">Ukraine</option>
            <option value="United Arab Emirates" data-select2-id="261">United Arab Emirates</option>
            <option value="United Kingdom" data-select2-id="262">United Kingdom</option>
            <option value="United States" data-select2-id="263">United States</option>
            <option value="United States Minor Outlying Islands" data-select2-id="264">United States Minor Outlying Islands</option>
            <option value="Uruguay" data-select2-id="265">Uruguay</option>
            <option value="Uzbekistan" data-select2-id="266">Uzbekistan</option>
            <option value="Vanuatu" data-select2-id="267">Vanuatu</option>
            <option value="Venezuela, Bolivarian Republic of" data-select2-id="268">Venezuela, Bolivarian Republic of</option>
            <option value="Viet Nam" data-select2-id="269">Viet Nam</option>
            <option value="Virgin Islands, British" data-select2-id="270">Virgin Islands, British</option>
            <option value="Virgin Islands, U.S." data-select2-id="271">Virgin Islands, U.S.</option>
            <option value="Wallis and Futuna" data-select2-id="272">Wallis and Futuna</option>
            <option value="Western Sahara" data-select2-id="273">Western Sahara</option>
            <option value="Yemen" data-select2-id="274">Yemen</option>
            <option value="Zambia" data-select2-id="275">Zambia</option>
            <option value="Zimbabwe" data-select2-id="276">Zimbabwe</option>
        </select>
    </div>
    <hr/>
    {!! Form::submit('Save', ['class' => 'btn btn-primary px-5']) !!}
    <a href="{{ route('ec.serviceOfferings.show', $taggable->id) }}" class="btn btn-warning btn-default px-5">Cancel</a>


    @push('page_css')
    @endpush

    @push('page_scripts')
    <script type="text/javascript">
        $(document).ready(function() {


            $("select[id='{{$control_id}}']").css('width', '100%');
            $("select[id='{{$control_id}}']").select2({
                theme: "classic",
                width: 'resolve',
                tags: "true",
                allowClear: true
            });

            // $("#{{$control_id}}").select2({
            //     theme: "classic",
            //     width: 'resolve' // need to override the changed default
            // });
        });
    </script>
    @endpush


@endif