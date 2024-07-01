<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->foreignId('domain_id')->constrained('domains')->cascadeOnDelete();
            $table->foreignId('subdomain_id')->nullable()->constrained('subdomains')->cascadeOnDelete();
            $table->string('slug');
            $table->timestamps();
        });

        DB::table('questions')->insert([
            [
                'name' => 'Both exterior and interior of building are clean.',
                'domain_id' => 1,
                'subdomain_id' => null,
                'slug' => 'd1q1'
            ],
            [
                'name' => 'Procedure room is clean.',
                'domain_id' => 1,
                'subdomain_id' => null,
                'slug' => 'd1q2'
            ],
            [
                'name' => 'Procedure room has light source.',
                'domain_id' => 1,
                'subdomain_id' => null,
                'slug' => 'd1q3'
            ],
            [
                'name' => 'Hand washing facility is functioning',
                'domain_id' => 1,
                'subdomain_id' => null,
                'slug' => 'd1q4'
            ],
            [
                'name' => 'Drinking water is available.',
                'domain_id' => 1,
                'subdomain_id' => null,
                'slug' => 'd1q5'
            ],
            [
                'name' => 'IEC materials are available.',
                'domain_id' => 1,
                'subdomain_id' => null,
                'slug' => 'd1q6'
            ],
            [
                'name' => 'Vinyls and posters for health education are visible to patients.',
                'domain_id' => 1,
                'subdomain_id' => null,
                'slug' => 'd1q7'
            ],
            [
                'name' => 'Procedures and guidelines are avaiable for clinic staffs.',
                'domain_id' => 1,
                'subdomain_id' => null,
                'slug' => 'd1q8'
            ],
            [
                'name' => 'Toilet (4 types of safety)',
                'domain_id' => 1,
                'subdomain_id' => null,
                'slug' => 'd1q9'
            ],
            [
                'name' => 'Patient waiting area (Patient waiting area/ chairs/ bench)',
                'domain_id' => 1,
                'subdomain_id' => null,
                'slug' => 'd1q10'
            ],
            [
                'name' => 'OPD area for reception',
                'domain_id' => 1,
                'subdomain_id' => null,
                'slug' => 'd1q11'
            ],
            [
                'name' => 'Room for examination (Private room for medical examination)',
                'domain_id' => 1,
                'subdomain_id' => null,
                'slug' => 'd1q12'
            ],
            [
                'name' => 'Pharmacy Store',
                'domain_id' => 1,
                'subdomain_id' => null,
                'slug' => 'd1q13'
            ],
            [
                'name' => 'Delivery Room',
                'domain_id' => 1,
                'subdomain_id' => null,
                'slug' => 'd1q14'
            ],
            [
                'name' => 'IPD room',
                'domain_id' => 1,
                'subdomain_id' => null,
                'slug' => 'd1q15'
            ],
            [
                'name' => 'Dressing Room',
                'domain_id' => 1,
                'subdomain_id' => null,
                'slug' => 'd1q16'
            ],
            [
                'name' => 'Dispensary Room',
                'domain_id' => 1,
                'subdomain_id' => null,
                'slug' => 'd1q17'
            ],
            [
                'name' => 'Room for Special Diseases',
                'domain_id' => 1,
                'subdomain_id' => null,
                'slug' => 'd1q18'
            ],
            [
                'name' => 'Doctors',
                'domain_id' => 2,
                'subdomain_id' => 1,
                'slug' => 'd2q1'
            ],
            [
                'name' => 'Nurses',
                'domain_id' => 2,
                'subdomain_id' => 1,
                'slug' => 'd2q2'
            ],
            [
                'name' => 'Health Assistants',
                'domain_id' => 2,
                'subdomain_id' => 1,
                'slug' => 'd2q3'
            ],
            [
                'name' => 'Medics',
                'domain_id' => 2,
                'subdomain_id' => 1,
                'slug' => 'd2q4'
            ],
            [
                'name' => 'MCH workers',
                'domain_id' => 2,
                'subdomain_id' => 1,
                'slug' => 'd2q5'
            ],
            [
                'name' => 'Mid-wives',
                'domain_id' => 2,
                'subdomain_id' => 1,
                'slug' => 'd2q6'
            ],
            [
                'name' => 'CHWs',
                'domain_id' => 2,
                'subdomain_id' => 1,
                'slug' => 'd2q7'
            ],
            [
                'name' => 'EmOC workers',
                'domain_id' => 2,
                'subdomain_id' => 1,
                'slug' => 'd2q8'
            ],
            [
                'name' => 'TTBAs',
                'domain_id' => 2,
                'subdomain_id' => 1,
                'slug' => 'd2q9'
            ],
            [
                'name' => 'Volunteers',
                'domain_id' => 2,
                'subdomain_id' => 1,
                'slug' => 'd2q10'
            ],
            [
                'name' => 'Clinic Supervisor',
                'domain_id' => 2,
                'subdomain_id' => 2,
                'slug' => 'd2q11'
            ],
            [
                'name' => 'Pharmacist',
                'domain_id' => 2,
                'subdomain_id' => 2,
                'slug' => 'd2q12'
            ],
            [
                'name' => 'Nurse-Aid',
                'domain_id' => 2,
                'subdomain_id' => 2,
                'slug' => 'd2q13'
            ],
            [
                'name' => 'Dental Care Provider',
                'domain_id' => 2,
                'subdomain_id' => 2,
                'slug' => 'd2q14'
            ],
            [
                'name' => 'TCM (Traditional Chinese Medicine)',
                'domain_id' => 2,
                'subdomain_id' => 2,
                'slug' => 'd2q15'
            ],
            [
                'name' => 'Establish good relationship with patient.(Def: Greet and welcome patient and make the patient comfortable)',
                'domain_id' => 3,
                'subdomain_id' => 3,
                'slug' => 'd3q1'
            ],
            [
                'name' => 'Provide the patient in privacy. (Def: Privacy means audio and visual proof.',
                'domain_id' => 3,
                'subdomain_id' => 3,
                'slug' => 'd3q2'
            ],
            [
                'name' => 'Patients are given time to ask questions.',
                'domain_id' => 3,
                'subdomain_id' => 3,
                'slug' => 'd3q3'
            ],
            [
                'name' => 'Responses are provided in layman terms ensure client understanding.',
                'domain_id' => 3,
                'subdomain_id' => 3,
                'slug' => 'd3q4'
            ],
            [
                'name' => 'Procedures and guidelines are avaiable for clinic staffs at the consultation room',
                'domain_id' => 3,
                'subdomain_id' => 3,
                'slug' => 'd3q5'
            ],
            [
                'name' => 'Patient record are kept with privacy. (Def: Privacy means nobody can access without any permission)မည်သူတစ်ဦးတစ်ယောက်မျှ ယူမသုံးနိုင်ခြင်းကိုဆိုလိုသည်။',
                'domain_id' => 3,
                'subdomain_id' => 3,
                'slug' => 'd3q6'
            ],
            [
                'name' => 'Vital signs are assessed. (Def: Vital signs mean BP, PR, RR, Temp)',
                'domain_id' => 3,
                'subdomain_id' => 4,
                'slug' => 'd3q7'
            ],
            [
                'name' => 'Chief complaint are recorded.',
                'domain_id' => 3,
                'subdomain_id' => 4,
                'slug' => 'd3q8'
            ],
            [
                'name' => 'Physical Examination are recorded.',
                'domain_id' => 3,
                'subdomain_id' => 4,
                'slug' => 'd3q9'
            ],
            [
                'name' => 'Final Diagnosis are recorded.',
                'domain_id' => 3,
                'subdomain_id' => 4,
                'slug' => 'd3q10'
            ],
            [
                'name' => 'Final Diagnosis and Treatment are inline with reference guideline.',
                'domain_id' => 3,
                'subdomain_id' => 4,
                'slug' => 'd3q11'
            ],
            [
                'name' => 'Follow-Up schedule is recorded.',
                'domain_id' => 3,
                'subdomain_id' => 4,
                'slug' => 'd3q12'
            ],
            [
                'name' => 'Team members carry out appropriate hand hygiene (washing or alcohol rub) BEFORE and AFTER examining or providing a service for EVERY client.',
                'domain_id' => 4,
                'subdomain_id' => 5,
                'slug' => 'd4q1'
            ],
            [
                'name' => 'Examination gloves are used when client care involves blood, body fluids, or laboratory specimens.',
                'domain_id' => 4,
                'subdomain_id' => 5,
                'slug' => 'd4q2'
            ],
            [
                'name' => 'Gloves are single use – i.e. a new pair of gloves is used for each client with used gloves disposed of as clinical waste',
                'domain_id' => 4,
                'subdomain_id' => 5,
                'slug' => 'd4q3'
            ],
            [
                'name' => 'Masks are only worn as specified by procedure',
                'domain_id' => 4,
                'subdomain_id' => 5,
                'slug' => 'd4q4'
            ],
            [
                'name' => 'Gowns are only worn as specified by procedure',
                'domain_id' => 4,
                'subdomain_id' => 5,
                'slug' => 'd4q5'
            ],
            [
                'name' => 'Aprons are worn during cleaning and instrument processing',
                'domain_id' => 4,
                'subdomain_id' => 5,
                'slug' => 'd4q6'
            ],
            [
                'name' => 'Clearly marked, puncture-resistant containers are available to dispose of contaminated sharps',
                'domain_id' => 4,
                'subdomain_id' => 6,
                'slug' => 'd4q7'
            ],
            [
                'name' => 'Needles are not recapped, bent or broken before disposal',
                'domain_id' => 4,
                'subdomain_id' => 6,
                'slug' => 'd4q8'
            ],
            [
                'name' => 'Contaminated equipment is not reused until it has been cleaned, disinfected, and sterilised properly.',
                'domain_id' => 4,
                'subdomain_id' => 6,
                'slug' => 'd4q9'
            ],
            [
                'name' => 'Wear heavy gloves and handle with care when washing sharp instruments.',
                'domain_id' => 4,
                'subdomain_id' => 6,
                'slug' => 'd4q10'
            ],
            [
                'name' => 'Post exposure prophylaxis policy is present',
                'domain_id' => 4,
                'subdomain_id' => 6,
                'slug' => 'd4q11'
            ],
            [
                'name' => 'Cleaning schedule for examination area is available.',
                'domain_id' => 4,
                'subdomain_id' => 6,
                'slug' => 'd4q12'
            ],
            [
                'name' => 'Clean and disinfect frequently touched surfaces including beds, bed rails, patient examination tables and bedside tables according to schedule',
                'domain_id' => 4,
                'subdomain_id' => 6,
                'slug' => 'd4q13'
            ],
            [
                'name' => 'Clean the area with disinfectant e.g. bleach, alcohol or iodine.',
                'domain_id' => 4,
                'subdomain_id' => 6,
                'slug' => 'd4q14'
            ],
            [
                'name' => 'Always use gloves when cleaning',
                'domain_id' => 4,
                'subdomain_id' => 6,
                'slug' => 'd4q15'
            ],
            [
                'name' => 'Wash hands with alcohol scrub or soap',
                'domain_id' => 4,
                'subdomain_id' => 6,
                'slug' => 'd4q16'
            ],
            [
                'name' => 'Wear following PPE: Mask',
                'domain_id' => 4,
                'subdomain_id' => 7,
                'slug' => 'd4q17'
            ],
            [
                'name' => 'Wear following PPE: Shoes',
                'domain_id' => 4,
                'subdomain_id' => 7,
                'slug' => 'd4q18'
            ],
            [
                'name' => 'Wear following PPE: Plastic apron',
                'domain_id' => 4,
                'subdomain_id' => 7,
                'slug' => 'd4q19'
            ],
            [
                'name' => 'Wear following PPE: Utility glove',
                'domain_id' => 4,
                'subdomain_id' => 7,
                'slug' => 'd4q20'
            ],
            [
                'name' => 'Clean instruments with soap water and brush',
                'domain_id' => 4,
                'subdomain_id' => 7,
                'slug' => 'd4q21'
            ],
            [
                'name' => 'Rinse the instruments with water',
                'domain_id' => 4,
                'subdomain_id' => 7,
                'slug' => 'd4q22'
            ],
            [
                'name' => 'Let the instruments dry for 45 min on the drying tray',
                'domain_id' => 4,
                'subdomain_id' => 7,
                'slug' => 'd4q23'
            ],
            [
                'name' => 'Remove following PPE and discard it: Mask in the bin',
                'domain_id' => 4,
                'subdomain_id' => 7,
                'slug' => 'd4q24'
            ],
            [
                'name' => 'Remove following PPE and discard it: Plastic apron clean and dry',
                'domain_id' => 4,
                'subdomain_id' => 7,
                'slug' => 'd4q25'
            ],
            [
                'name' => 'Remove following PPE and discard it: Utility glove clean and dry',
                'domain_id' => 4,
                'subdomain_id' => 7,
                'slug' => 'd4q26'
            ],
            [
                'name' => 'Wash hands with alcohol scrub or soap before processing.',
                'domain_id' => 4,
                'subdomain_id' => 7,
                'slug' => 'd4q27'
            ],
            [
                'name' => 'Wear a Cap',
                'domain_id' => 4,
                'subdomain_id' => 7,
                'slug' => 'd4q28'
            ],
            [
                'name' => 'Put in Autoclave management',
                'domain_id' => 4,
                'subdomain_id' => 7,
                'slug' => 'd4q29'
            ],
            [
                'name' => 'Keep the instruments to cold 20 minutes',
                'domain_id' => 4,
                'subdomain_id' => 7,
                'slug' => 'd4q30'
            ],
            [
                'name' => 'Wash your hands with alcohol scrub or soap after processing',
                'domain_id' => 4,
                'subdomain_id' => 7,
                'slug' => 'd4q31'
            ],
            [
                'name' => 'A housekeeping schedule is available',
                'domain_id' => 4,
                'subdomain_id' => 8,
                'slug' => 'd4q32'
            ],
            [
                'name' => 'Toilets and hand washing facilities are clean and in good repair.',
                'domain_id' => 4,
                'subdomain_id' => 8,
                'slug' => 'd4q33'
            ],
            [
                'name' => 'Housekeepers wear utility gloves and aprons when handling medical waste and cleaning',
                'domain_id' => 4,
                'subdomain_id' => 8,
                'slug' => 'd4q34'
            ],
            [
                'name' => 'A waste management plan is available',
                'domain_id' => 4,
                'subdomain_id' => 8,
                'slug' => 'd4q35'
            ],
            [
                'name' => 'Clinical waste and general waste is segregated and stored in different areas prior to disposal',
                'domain_id' => 4,
                'subdomain_id' => 8,
                'slug' => 'd4q36'
            ],
            [
                'name' => 'Social Distancing for waiting area.',
                'domain_id' => 4,
                'subdomain_id' => 9,
                'slug' => 'd4q37'
            ],
            [
                'name' => 'Hand Washing Facility at the entrance of the clinic.',
                'domain_id' => 4,
                'subdomain_id' => 9,
                'slug' => 'd4q38'
            ],
            [
                'name' => 'Fever Screening at the entrance of the clinic.',
                'domain_id' => 4,
                'subdomain_id' => 9,
                'slug' => 'd4q39'
            ],
            [
                'name' => 'Wear Masks when examining the patient.',
                'domain_id' => 4,
                'subdomain_id' => 9,
                'slug' => 'd4q40'
            ],
            [
                'name' => 'Vital signs are assessed. (Def: Vital signs mean BP, PR, RR, Temp)',
                'domain_id' => 5,
                'subdomain_id' => 14,
                'slug' => 'd5q1'
            ],
            [
                'name' => 'Chief complaint are recorded.',
                'domain_id' => 5,
                'subdomain_id' => 14,
                'slug' => 'd5q2'
            ],
            [
                'name' => 'RDT testing was done',
                'domain_id' => 5,
                'subdomain_id' => 14,
                'slug' => 'd5q3'
            ],
            [
                'name' => 'RDT test result was recorded',
                'domain_id' => 5,
                'subdomain_id' => 14,
                'slug' => 'd5q4'
            ],
            [
                'name' => 'Treatment follow national protocol',
                'domain_id' => 5,
                'subdomain_id' => 14,
                'slug' => 'd5q5'
            ],
            [
                'name' => 'RDT testing demonstration',
                'domain_id' => 5,
                'subdomain_id' => 14,
                'slug' => 'd5q6'
            ],
            [
                'name' => 'Vital signs are assessed. (Def: Vital signs mean BP, PR, RR, Temp',
                'domain_id' => 5,
                'subdomain_id' => 15,
                'slug' => 'd5q7'
            ],
            [
                'name' => 'Chief complaint are recorded.',
                'domain_id' => 5,
                'subdomain_id' => 15,
                'slug' => 'd5q8'
            ],
            [
                'name' => 'Sputum testing was done.',
                'domain_id' => 5,
                'subdomain_id' => 15,
                'slug' => 'd5q9'
            ],
            [
                'name' => 'Sputum result was recorded.',
                'domain_id' => 5,
                'subdomain_id' => 15,
                'slug' => 'd5q10'
            ],
            [
                'name' => 'DOT was done.',
                'domain_id' => 5,
                'subdomain_id' => 15,
                'slug' => 'd5q11'
            ],
            [
                'name' => 'Vital signs are assessed. (Def: Vital signs mean BP, PR, RR, Temp)',
                'domain_id' => 5,
                'subdomain_id' => 14,
                'slug' => 'd5q12'
            ],
            [
                'name' => 'Chief complaint are recorded.',
                'domain_id' => 5,
                'subdomain_id' => 14,
                'slug' => 'd5q13'
            ],
            [
                'name' => 'Pre-test counselling service was given',
                'domain_id' => 5,
                'subdomain_id' => 14,
                'slug' => 'd5q14'
            ],
            [
                'name' => 'HIV screening test was done.',
                'domain_id' => 5,
                'subdomain_id' => 14,
                'slug' => 'd5q15'
            ],
            [
                'name' => 'HIV test result was recorded.',
                'domain_id' => 5,
                'subdomain_id' => 14,
                'slug' => 'd5q16'
            ],
            [
                'name' => 'Post-test counselling service was given.',
                'domain_id' => 5,
                'subdomain_id' => 14,
                'slug' => 'd5q17'
            ],
            [
                'name' => 'Referral to Township Health Department was done.',
                'domain_id' => 5,
                'subdomain_id' => 14,
                'slug' => 'd5q18'
            ],
            [
                'name' => 'Keep the medicines and supplies properly on the shelf in store room',
                'domain_id' => 5,
                'subdomain_id' => 15,
                'slug' => 'd5q19'
            ],
            [
                'name' => 'Temperature record is available',
                'domain_id' => 5,
                'subdomain_id' => 15,
                'slug' => 'd5q20'
            ],
            [
                'name' => 'Store the medicine in the proper room temperature',
                'domain_id' => 5,
                'subdomain_id' => 15,
                'slug' => 'd5q21'
            ],
            [
                'name' => 'Discard the expire medicines and supplies properly',
                'domain_id' => 5,
                'subdomain_id' => 15,
                'slug' => 'd5q22'
            ],
            [
                'name' => 'Replenish the medicines and supplies with stock balance',
                'domain_id' => 5,
                'subdomain_id' => 15,
                'slug' => 'd5q23'
            ],
            [
                'name' => 'Clinical team members (All) received Emergency Management training.',
                'domain_id' => 6,
                'subdomain_id' => 18,
                'slug' => 'd6q1'
            ],
            [
                'name' => 'Emergency Management equipments are easily available. (spare in stock or can be managed if expired or out of stock)',
                'domain_id' => 6,
                'subdomain_id' => 18,
                'slug' => 'd6q2'
            ],
            [
                'name' => 'Regular check for emergency equipment was done.',
                'domain_id' => 6,
                'subdomain_id' => 19,
                'slug' => 'd6q3'
            ],
            [
                'name' => 'All drugs kept in clearly marked separate boxes/packages/containers. with contents, dosage and expiry dates clearly visible.',
                'domain_id' => 6,
                'subdomain_id' => 19,
                'slug' => 'd6q4'
            ],
            [
                'name' => 'Suction for airway is available. Electric/manual.',
                'domain_id' => 6,
                'subdomain_id' => 19,
                'slug' => 'd6q5'
            ],
            [
                'name' => 'Ambu bag/valve mask is available',
                'domain_id' => 6,
                'subdomain_id' => 19,
                'slug' => 'd6q6'
            ],
            [
                'name' => 'There are materials to give oxygen in situation of emergency',
                'domain_id' => 6,
                'subdomain_id' => 19,
                'slug' => 'd6q7'
            ],
            [
                'name' => 'IV Cannulae in various gauge ( adult and child )',
                'domain_id' => 6,
                'subdomain_id' => 19,
                'slug' => 'd6q8'
            ],
            [
                'name' => 'IV giving set',
                'domain_id' => 6,
                'subdomain_id' => 19,
                'slug' => 'd6q9'
            ],
            [
                'name' => 'Sterile gloves x 2 pairs each of small and large',
                'domain_id' => 6,
                'subdomain_id' => 19,
                'slug' => 'd6q10'
            ],
            [
                'name' => 'Syringes and needles, size 2ml, 5ml, 20ml',
                'domain_id' => 6,
                'subdomain_id' => 19,
                'slug' => 'd6q11'
            ],
            [
                'name' => 'Tourniquet',
                'domain_id' => 6,
                'subdomain_id' => 19,
                'slug' => 'd6q12'
            ],
            [
                'name' => 'Stethoscope',
                'domain_id' => 6,
                'subdomain_id' => 19,
                'slug' => 'd6q13'
            ],
            [
                'name' => 'BP cuff',
                'domain_id' => 6,
                'subdomain_id' => 19,
                'slug' => 'd6q14'
            ],
            [
                'name' => 'Glucometer',
                'domain_id' => 6,
                'subdomain_id' => 19,
                'slug' => 'd6q15'
            ],
            [
                'name' => 'Pulse Oximeter',
                'domain_id' => 6,
                'subdomain_id' => 19,
                'slug' => 'd6q16'
            ],
            [
                'name' => 'Urine catheter and bag (adult size catheter)',
                'domain_id' => 6,
                'subdomain_id' => 19,
                'slug' => 'd6q17'
            ],
            [
                'name' => 'Atropine sufficient for 2 x 3mg doses (usually stocked in 0.5mg or 0.6mg vials)',
                'domain_id' => 6,
                'subdomain_id' => 18,
                'slug' => 'd6q18'
            ],
            [
                'name' => 'Adrenaline 1 in 1,000 x 2',
                'domain_id' => 6,
                'subdomain_id' => 18,
                'slug' => 'd6q19'
            ],
            [
                'name' => 'Chlorpheniramine 10mg/ml x 2 ampoules or equivalent antihistamine',
                'domain_id' => 6,
                'subdomain_id' => 18,
                'slug' => 'd6q20'
            ],
            [
                'name' => 'Hydrocortisone 100mg x 2 powder vials',
                'domain_id' => 6,
                'subdomain_id' => 18,
                'slug' => 'd6q21'
            ],
            [
                'name' => 'Salbutamol 2.5mg Inhaler',
                'domain_id' => 6,
                'subdomain_id' => 18,
                'slug' => 'd6q22'
            ],
            [
                'name' => '25% Glucose and/or 50% for IV use in hypoglycaemia',
                'domain_id' => 6,
                'subdomain_id' => 18,
                'slug' => 'd6q23'
            ],
            [
                'name' => 'Diazepam 10mg (for IV use)',
                'domain_id' => 6,
                'subdomain_id' => 18,
                'slug' => 'd6q24'
            ],
            [
                'name' => 'Water for injection',
                'domain_id' => 6,
                'subdomain_id' => 18,
                'slug' => 'd6q25'
            ],
            [
                'name' => 'Oxytocin 10IU/ml or 5IU/ml',
                'domain_id' => 6,
                'subdomain_id' => 18,
                'slug' => 'd6q26'
            ],
            [
                'name' => '0.9% Saline 500ml, x 2 bags or equivalent',
                'domain_id' => 6,
                'subdomain_id' => 19,
                'slug' => 'd6q27'
            ],
            [
                'name' => 'Hartmans solution,/ Ringers Lactate x 2 bags or 1L equivalent',
                'domain_id' => 6,
                'subdomain_id' => 19,
                'slug' => 'd6q28'
            ],
            [
                'name' => 'Clinical team members received MRH training?',
                'domain_id' => 7,
                'subdomain_id' => 20,
                'slug' => 'd7q1'
            ],
            [
                'name' => 'What is Respectful Maternity Care?',
                'domain_id' => 7,
                'subdomain_id' => 20,
                'slug' => 'd7q2'
            ],
            [
                'name' => 'What are the contraceptive methods?',
                'domain_id' => 7,
                'subdomain_id' => 20,
                'slug' => 'd7q3'
            ],
            [
                'name' => 'What is family planning counseling?',
                'domain_id' => 7,
                'subdomain_id' => 20,
                'slug' => 'd7q4'
            ],
            [
                'name' => 'ကိုယ်ဝန်ဆောင်စောင့်ရှောက်မှုပေးရမည့်အချိန်ကာလ (ANC Timing)',
                'domain_id' => 7,
                'subdomain_id' => 20,
                'slug' => 'd7q5'
            ],
            [
                'name' => 'Abdominal examination ပြုလုပ်စဥ် ပါဝင်ရမည့် အချက်များကို သင်မှတ်မိသလောက် ဖော်ပြပါ။',
                'domain_id' => 7,
                'subdomain_id' => 20,
                'slug' => 'd7q6'
            ],
            [
                'name' => 'ကလေးမမွေးဖွားမီသွေးသွန်ခြင်းကို ဖြစ်စေသည့်အကြောင်းရင်းများ (အနည်းဆုံး ၃ချက်ကို ဖြေသင့်ပါသည်)',
                'domain_id' => 7,
                'subdomain_id' => 20,
                'slug' => 'd7q7'
            ],
            [
                'name' => 'ကလေးမွေးဖွားခြင်းတတိယအဆင့်ကို ပြုလုပ်ရမည့် အချက်များကို မှတ်မိသလောက် ဖော်ပြပါ။',
                'domain_id' => 7,
                'subdomain_id' => 20,
                'slug' => 'd7q8'
            ],
            [
                'name' => 'မွေးဖွားမှုဖြစ်စဥ်ပြဇယား (partograph) ၏အစိတ်အပိုင်းများ ကိုဖော်ပြပါ။ ၁) မိခင်အခြေအနေ 2) သန္ဓေသားလောင်း၏ အခြေအနေ ၃) မွေးဖွားခြင်းဖြစ်စဥ်တိုးတက်မှု',
                'domain_id' => 7,
                'subdomain_id' => 20,
                'slug' => 'd7q9'
            ],
            [
                'name' => 'Causes of PPH (မွေးဖွားပြီး သွေးသွန်ခြင်းကို ဖြစ်စေသော အကြောင်းအရာများ)',
                'domain_id' => 7,
                'subdomain_id' => 20,
                'slug' => 'd7q10'
            ],
            [
                'name' => 'မွေးပြီးစောင့်ရှောက်မှုပေးရမည့်အချိန်ကာလ',
                'domain_id' => 7,
                'subdomain_id' => 20,
                'slug' => 'd7q11'
            ],
            [
                'name' => 'လူနာကုတင် ( ANC bed) ၊ အိပ်ရာခင်း၊ စောင်၊ ခေါင်းအုံး',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q12'
            ],
            [
                'name' => 'မွေးကုတင်(delivery bed)',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q13'
            ],
            [
                'name' => 'မွေးဖွားပြီးချိန် နားနေကုတင် (PNC bed)',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q14'
            ],
            [
                'name' => 'Gooseneck မီးအိမ်',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q15'
            ],
            [
                'name' => 'Umbilical clump ( forceps ) 8" : 2 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q16'
            ],
            [
                'name' => 'Sponge forceps 9" size : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q17'
            ],
            [
                'name' => 'Dissecting forceps with tooth 13 cm. : 2 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q18'
            ],
            [
                'name' => 'Tenaculum : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q19'
            ],
            [
                'name' => 'Forceps Jar (2" x 4.5") : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q20'
            ],
            [
                'name' => 'Artery Forceps Curves : 3 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q21'
            ],
            [
                'name' => 'Cheatle forcep : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q22'
            ],
            [
                'name' => 'Episiotomy scissor 14" : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q23'
            ],
            [
                'name' => 'Umbilical scissor 10.5 cm. : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q24'
            ],
            [
                'name' => 'Needle holder (10-16) 16 cm : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q25'
            ],
            [
                'name' => 'Kidney Tray (Big Side) 10" : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q26'
            ],
            [
                'name' => 'Instruments tray (Big Side) 12"x 8"x 2" : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q27'
            ],
            [
                'name' => 'Uterine Sound : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q28'
            ],
            [
                'name' => 'Small bowl (with cover ) 5"X 5" : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q29'
            ],
            [
                'name' => 'Small bowl (without cover ) 4"x 3" : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q30'
            ],
            [
                'name' => 'Speculum grave or cusco small : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q31'
            ],
            [
                'name' => 'Speculum grave or cusco medium : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q32'
            ],
            [
                'name' => 'Speculum grave or cusco large : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q33'
            ],
            [
                'name' => 'Sims Vaginal speculum : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q34'
            ],
            [
                'name' => 'Digital Weight scale ( For baby) : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q35'
            ],
            [
                'name' => 'Weight scale ( Adult ) : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q36'
            ],
            [
                'name' => 'Weight scale ( For baby) (Hanging) : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q37'
            ],
            [
                'name' => 'Manual Vacuum Aspiration (MVA) Set : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q38'
            ],
            [
                'name' => 'Kiwi suction set : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q39'
            ],
            [
                'name' => 'Non-stretchable Measuring Tape : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q40'
            ],
            [
                'name' => 'Cord Ties /Cord clamp : 2 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q41'
            ],
            [
                'name' => 'Suction Ball / Penguin Suction : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q42'
            ],
            [
                'name' => 'Bed pan -Plastic : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q43'
            ],
            [
                'name' => 'Breast pump : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q44'
            ],
            [
                'name' => 'Boiling Pot : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q45'
            ],
            [
                'name' => 'Head light : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q46'
            ],
            [
                'name' => 'Nasogastric tube ( neonate) 2 sizes : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q47'
            ],
            [
                'name' => 'Rubber boots : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q48'
            ],
            [
                'name' => 'Goggle and cap : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q49'
            ],
            [
                'name' => 'Apron : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q50'
            ],
            [
                'name' => 'Suturing thread or Nylon various numbers : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q51'
            ],
            [
                'name' => 'Suturing chromic various numbers : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q52'
            ],
            [
                'name' => 'Wool Cap for newborn : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q53'
            ],
            [
                'name' => 'Wool gloves & socks for newborn : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q54'
            ],
            [
                'name' => 'Resuscitation Bag for newborn : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q55'
            ],
            [
                'name' => 'Resuscitation Mask 2 sizes for newborn : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q56'
            ],
            [
                'name' => 'Warm towels : 3 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q57'
            ],
            [
                'name' => 'Clean Plastic bag : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q58'
            ],
            [
                'name' => 'Surgical Glove No. 6, 6.5, 7, 7.5 : 2 each Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q59'
            ],
            [
                'name' => 'Urinary Catheter Size 10/12/14 : 1 each Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q60'
            ],
            [
                'name' => 'Sphymomanometer Normal Adult : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q61'
            ],
            [
                'name' => 'Sphymomanometer big cuff Adult : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q62'
            ],
            [
                'name' => 'Stethoscope (Adult) : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q63'
            ],
            [
                'name' => 'Fetal Stethoscope : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q64'
            ],
            [
                'name' => 'Thermometer : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q65'
            ],
            [
                'name' => 'KMC wrapping : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q66'
            ],
            [
                'name' => 'Pulse oximeter : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q67'
            ],
            [
                'name' => 'Oxygen cylinder : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q68'
            ],
            [
                'name' => 'Oxygen nasal cannula for baby : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q69'
            ],
            [
                'name' => 'Oxygen Mask for mother : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q70'
            ],
            [
                'name' => 'Cannula yellow & purple for newborn IV line : 5 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q71'
            ],
            [
                'name' => 'Helping Babies Breathe Action Plan Chart : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q72'
            ],
            [
                'name' => 'Peadiatric drip set (60 dropper) : 2 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q73'
            ],
            [
                'name' => 'Functioning Wall clock : 1 Number or Set',
                'domain_id' => 7,
                'subdomain_id' => 21,
                'slug' => 'd7q74'
            ],
            [
                'name' => 'Knowledge on importance of U5 mortality and neonatal mortality. - U5 mortality is an indicator for the country health status - Among U5 mortality, neonatal mortality is the highest. (~50%). It means if neonatal mortality drops down well U5 child mortality will be down.',
                'domain_id' => 8,
                'subdomain_id' => 24,
                'slug' => 'd8q1'
            ],
            [
                'name' => 'Common causes of under 5 mortality in Myanmar? (neonatal & > neonate U5)- Neonatal mortality - 3 causes: sepsis and pneumonia, prematurity, birth asphyxia  - U5 motality: - 2 causes: pneumonia, diarrhoea',
                'domain_id' => 8,
                'subdomain_id' => 24,
                'slug' => 'd8q2'
            ],
            [
                'name' => 'Whether the health worker has attended Integrated Management of Childhood Illness full course (11 days and +) or not? If YES, please describe detail in the remark column.',
                'domain_id' => 8,
                'subdomain_id' => 24,
                'slug' => 'd8q3'
            ],
            [
                'name' => 'Knowledge on growth assessment in under 5 children.- weight x age - weight x height/length - age x height/length - head circumference  - MUAC (လက်မောင်းလုံးပတ်တိုင်းတာခြင်း)',
                'domain_id' => 8,
                'subdomain_id' => 25,
                'slug' => 'd8q4'
            ],
            [
                'name' => 'MUAC tape is available or not and used or not? From which age start to measure and how often should measure? - MUAC should start to measure from 6 months to 5 years (၆ လ မှ ၅ နှစ်အရွယ် ကလေးများ) - MUAC should measure 3 monthly, at least twice a year. (၃ လ တစ်ကြိမ် တိုင်းတာသင့်ပါသည်။ အနည်းဆုံးတော့ တစ်နှစ် ၂ ကြိမ်တိုင်းတာသင့်ပါသည်။)',
                'domain_id' => 8,
                'subdomain_id' => 25,
                'slug' => 'd8q5'
            ],
            [
                'name' => 'Classification of malnutrition based on MUAC - < 11.5 cm , severe acute malnutrition (SAM) (refer urgently NOT necessary immediately) - 11.5 cm to <12.5 cm, moderate acute malnutrition (MAM)',
                'domain_id' => 8,
                'subdomain_id' => 25,
                'slug' => 'd8q6'
            ],
            [
                'name' => 'Functioning resuscitation bag & mask (2 sizes) for neonate',
                'domain_id' => 8,
                'subdomain_id' => 24,
                'slug' => 'd8q7'
            ],
            [
                'name' => 'Functioning resuscitation bag & masks for children',
                'domain_id' => 8,
                'subdomain_id' => 24,
                'slug' => 'd8q8'
            ],
            [
                'name' => 'NeoNatalie Newborn Educational Manikin available? (only in main/training centre)',
                'domain_id' => 8,
                'subdomain_id' => 24,
                'slug' => 'd8q9'
            ],
            [
                'name' => 'Functioning pulse oximeter with batteries',
                'domain_id' => 8,
                'subdomain_id' => 24,
                'slug' => 'd8q10'
            ],
            [
                'name' => 'Measurement for height & weight (Stadiometer and length board) If not available how to measure?',
                'domain_id' => 8,
                'subdomain_id' => 24,
                'slug' => 'd8q11'
            ],
            [
                'name' => 'Functioning glucometer with batteries (If not available how to measure blood glucose?)',
                'domain_id' => 8,
                'subdomain_id' => 24,
                'slug' => 'd8q12'
            ],
            [
                'name' => 'Functioning Neubilizer machine available?',
                'domain_id' => 8,
                'subdomain_id' => 24,
                'slug' => 'd8q13'
            ],
            [
                'name' => 'Functioning oxygen cylinder / concentrator available? (Although machine is not damage concentrator is appropriate to use power source or not. If oxygen cylinder oxygen empty how to refill. It is possible to do it?)',
                'domain_id' => 8,
                'subdomain_id' => 24,
                'slug' => 'd8q14'
            ],
            [
                'name' => 'Intravascular cannula for newborn drip (yellow & / or blue colour) available?',
                'domain_id' => 8,
                'subdomain_id' => 24,
                'slug' => 'd8q15'
            ],
            [
                'name' => 'Nasogastric tube for babies available ?(yellow &/or blue colour)',
                'domain_id' => 8,
                'subdomain_id' => 24,
                'slug' => 'd8q16'
            ],
            [
                'name' => 'Knowledge on four danger signs?  - Unable to drink or breastfeed  - Vomit everything - Convulsions during this illness  - Lethargic or unconscious',
                'domain_id' => 8,
                'subdomain_id' => 25,
                'slug' => 'd8q17'
            ],
            [
                'name' => 'Signs of pneumonia - presence of fast breathing and/or chest indrawing and/or O2 satuaration SPO2 <90%. Fast breathing means - Up to 2 months: 60 or above breaths/minute - >2 months up to 12 months: 50 or more breaths/minute - 12 months up to 5 years: 40 or more breaths per minute',
                'domain_id' => 8,
                'subdomain_id' => 25,
                'slug' => 'd8q18'
            ],
            [
                'name' => 'Signs of dehydration  - Lethargic or unconscious  - Sunken eyes (noticed during this dehydration problem)  - Drink eagerly or Not able to drink if severely dehydrated - Skin pinch goes back slowly or very slowly',
                'domain_id' => 8,
                'subdomain_id' => 25,
                'slug' => 'd8q19'
            ],
            [
                'name' => 'How to dilute ORS solution correctly?  - ORS 1 sachet + 1 litre of water (Please check on the sacchet either 1000cc or 500 cc of cool boiled water should be added. It depend on amount of ORS powder in the sachet)',
                'domain_id' => 8,
                'subdomain_id' => 25,
                'slug' => 'd8q20'
            ],
            [
                'name' => 'Assess how to give oral rehydration solution for diarrhoea / dehydrated child.  - Up to 2 years: 50 to 100 ml after each loose stool  - 2 years or more: 100 to 200 ml after each loose stool ',
                'domain_id' => 8,
                'subdomain_id' => 25,
                'slug' => 'd8q21'
            ],
            [
                'name' => 'Assess knowledge on how to make Salt-Sugar-Solution (SSS) if ORS packs are stock out.  - Eight (8) level teaspoons of sugar. - Half (1/2) level teaspoon of salt. - 1L (litre) of clean drinking or boiled water and then cooled - 5 cupful (each cup about 200 ml.)',
                'domain_id' => 8,
                'subdomain_id' => 25,
                'slug' => 'd8q22'
            ],
            [
                'name' => 'How to diagnose Malaria? - Malaria test (RDT) (+) ve and/or  - blood film',
                'domain_id' => 8,
                'subdomain_id' => 25,
                'slug' => 'd8q23'
            ],
            [
                'name' => 'Signs of measles?  - Generalised rash with  - Cough - Coryza - Conjuntivitis',
                'domain_id' => 8,
                'subdomain_id' => 25,
                'slug' => 'd8q24'
            ],
            [
                'name' => 'Signs and Symptoms of DHF - High fever (40°C/104°F) and the following symptoms during the febrile phase:  - severe headache - pain behind the eyes - muscle and joint pains - rash - Bleeding i.e bleeding gum - Hess test + ve - Later develop, weak pulse, narrow pulse pressure, hypotension, shock',
                'domain_id' => 8,
                'subdomain_id' => 25,
                'slug' => 'd8q25'
            ],
            [
                'name' => 'Signs of severe acute malnutrition  - Oedema of both feet AND/OR - Severe wasting AND/OR - WFH/L less than -3 line AND/OR - MUAC less than 115 mm',
                'domain_id' => 8,
                'subdomain_id' => 25,
                'slug' => 'd8q26'
            ],
            [
                'name' => 'Signs of anaemia?  - Palmar pallor and/or  - Conjuntiva pallor',
                'domain_id' => 8,
                'subdomain_id' => 25,
                'slug' => 'd8q27'
            ],
            [
                'name' => 'Common signs & symptoms of childhood PTB:  - unwell without any cause,  - unexplained fever X 2 wks,  - loss of appetite,  - failure to thrive,  - weight lost,  - coughing X 2 wks and not improved by antibiotics.  - If any person of close contact has PTB, the child has more chance to get PTB.',
                'domain_id' => 8,
                'subdomain_id' => 25,
                'slug' => 'd8q28'
            ],
            [
                'name' => 'After birth what immunizations should give for new born babies? - BCG - Hepatitis B (HPV)',
                'domain_id' => 8,
                'subdomain_id' => 25,
                'slug' => 'd8q29'
            ],
            [
                'name' => 'When Measles immunization should be given to a baby? How often do you give as a routine? - At 9 months (1st dose) - At 1 year 6 months (2nd dose)',
                'domain_id' => 8,
                'subdomain_id' => 25,
                'slug' => 'd8q30'
            ],
            [
                'name' => 'Assess knowledge on points to check as soon as the baby is delivered - Breathing- Heart Rate - Colour - (Tone) If mention above 3 it should consider complete answer.',
                'domain_id' => 8,
                'subdomain_id' => 25,
                'slug' => 'd8q31'
            ],
            [
                'name' => 'Assess the knowledge of severe jaundice in newborn? - Any jaundice if age less than 24 hours OR Jaundice (yellow) up to palms and sole',
                'domain_id' => 8,
                'subdomain_id' => 25,
                'slug' => 'd8q32'
            ],
            [
                'name' => 'For Normal infant, how many times breastfeed in 24 hours? 8 times / 3 hourly',
                'domain_id' => 8,
                'subdomain_id' => 25,
                'slug' => 'd8q33'
            ],
            [
                'name' => 'For Normal infant, how many months mom should offer breastfeeding? full 6 months',
                'domain_id' => 8,
                'subdomain_id' => 25,
                'slug' => 'd8q34'
            ],
            [
                'name' => 'For Normal infant, while offering these months do we need to add other fluids, water or food? No food even water should not give to baby within 6 months of age except breastfeeding. (We can give ORS or medication if necessary)',
                'domain_id' => 8,
                'subdomain_id' => 25,
                'slug' => 'd8q35'
            ],
            [
                'name' => 'When we should start Complementary feeding to normal infant? - 6 months',
                'domain_id' => 8,
                'subdomain_id' => 25,
                'slug' => 'd8q36'
            ],
            [
                'name' => 'When we should start Vitamin A supplementation in normal infant?  - 6 months',
                'domain_id' => 8,
                'subdomain_id' => 25,
                'slug' => 'd8q37'
            ],
            [
                'name' => 'When we should start deworming in normal infant?  - 1 year',
                'domain_id' => 8,
                'subdomain_id' => 25,
                'slug' => 'd8q38'
            ],
            [
                'name' => 'Define prematurity?  - Gestational age <37 weeks',
                'domain_id' => 8,
                'subdomain_id' => 25,
                'slug' => 'd8q39'
            ],
            [
                'name' => 'Define Low Birth Weight? - Body Weight <2.5 kg',
                'domain_id' => 8,
                'subdomain_id' => 25,
                'slug' => 'd8q40'
            ],
            [
                'name' => 'Patient Booklet',
                'domain_id' => 9,
                'subdomain_id' => null,
                'slug' => 'd9q1'
            ],
            [
                'name' => 'Patient Register Logbook',
                'domain_id' => 9,
                'subdomain_id' => null,
                'slug' => 'd9q2'
            ],
            [
                'name' => 'OPD Logbook',
                'domain_id' => 9,
                'subdomain_id' => null,
                'slug' => 'd9q3'
            ],
            [
                'name' => 'Referral forms/referral logbook',
                'domain_id' => 9,
                'subdomain_id' => null,
                'slug' => 'd9q4'
            ],
            [
                'name' => 'Mobile form/ Logbook for mobile team',
                'domain_id' => 9,
                'subdomain_id' => null,
                'slug' => 'd9q5'
            ],
            [
                'name' => 'ANC Chart/ Logbook/ MCH handbook',
                'domain_id' => 9,
                'subdomain_id' => null,
                'slug' => 'd9q6'
            ],
            [
                'name' => 'Delivery Chart/ Logbook',
                'domain_id' => 9,
                'subdomain_id' => null,
                'slug' => 'd9q7'
            ],
            [
                'name' => 'PNC Chat/ Logbook',
                'domain_id' => 9,
                'subdomain_id' => null,
                'slug' => 'd9q8'
            ],
            [
                'name' => 'TTBA Forms',
                'domain_id' => 9,
                'subdomain_id' => null,
                'slug' => 'd9q9'
            ],
            [
                'name' => 'AMW Forms',
                'domain_id' => 9,
                'subdomain_id' => null,
                'slug' => 'd9q10'
            ],
            [
                'name' => 'FP Chart/ Logbook',
                'domain_id' => 9,
                'subdomain_id' => null,
                'slug' => 'd9q11'
            ],
            [
                'name' => 'RH Chart/ Logbook',
                'domain_id' => 9,
                'subdomain_id' => null,
                'slug' => 'd9q12'
            ],
            [
                'name' => 'GM Chart/ Logbook',
                'domain_id' => 9,
                'subdomain_id' => null,
                'slug' => 'd9q13'
            ],
            [
                'name' => 'IMCI 1 Chart/ Logbook',
                'domain_id' => 9,
                'subdomain_id' => null,
                'slug' => 'd9q14'
            ],
            [
                'name' => 'IMCI 2 Chart/ Logbook',
                'domain_id' => 9,
                'subdomain_id' => null,
                'slug' => 'd9q15'
            ],
            [
                'name' => 'IPD Chart/ Logbook',
                'domain_id' => 9,
                'subdomain_id' => null,
                'slug' => 'd9q16'
            ],
            [
                'name' => 'Amoxicillin for Pneumonia Treatment',
                'domain_id' => 10,
                'subdomain_id' => 32,
                'slug' => 'd10q1'
            ],
            [
                'name' => 'Oral Rehydration Salt for Diarrhoea Treatment',
                'domain_id' => 10,
                'subdomain_id' => 32,
                'slug' => 'd10q2'
            ],
            [
                'name' => 'Zinc for Diarrhoea Treatment',
                'domain_id' => 10,
                'subdomain_id' => 32,
                'slug' => 'd10q3'
            ],
            [
                'name' => 'Ferrous Sulphate (FESO4) for Antenatal Care',
                'domain_id' => 10,
                'subdomain_id' => 32,
                'slug' => 'd10q4'
            ],
            [
                'name' => 'Vitamin B1 (Thiamine) for Antenatal Care',
                'domain_id' => 10,
                'subdomain_id' => 32,
                'slug' => 'd10q5'
            ],
            [
                'name' => 'Malaria Rapid Test Kit for Malaria Testing',
                'domain_id' => 10,
                'subdomain_id' => 32,
                'slug' => 'd10q6'
            ],
            [
                'name' => 'Artemesanine-based Combination Therapy (ACT) for Malaria (Artemether+Lumifantrine)',
                'domain_id' => 10,
                'subdomain_id' => 32,
                'slug' => 'd10q7'
            ],
            [
                'name' => 'Primaquine for Malaria Treatment',
                'domain_id' => 10,
                'subdomain_id' => 32,
                'slug' => 'd10q8'
            ],
            [
                'name' => 'Chloroquine for Malaria Treatment',
                'domain_id' => 10,
                'subdomain_id' => 32,
                'slug' => 'd10q9'
            ],
            [
                'name' => 'Paracetamol for Fever in Malaria',
                'domain_id' => 10,
                'subdomain_id' => 32,
                'slug' => 'd10q10'
            ],
            [
                'name' => 'Item 1',
                'domain_id' => 10,
                'subdomain_id' => 31,
                'slug' => 'd10q11'
            ],
            [
                'name' => 'Item 2',
                'domain_id' => 10,
                'subdomain_id' => 31,
                'slug' => 'd10q12'
            ],
            [
                'name' => 'Item 3',
                'domain_id' => 10,
                'subdomain_id' => 31,
                'slug' => 'd10q13'
            ],
            [
                'name' => 'Chlorine-based disinfectant',
                'domain_id' => 10,
                'subdomain_id' => 32,
                'slug' => 'd10q14'
            ],
            [
                'name' => 'Latex gloves (clean or sterile)',
                'domain_id' => 10,
                'subdomain_id' => 32,
                'slug' => 'd10q15'
            ],
            [
                'name' => 'Sharps container',
                'domain_id' => 10,
                'subdomain_id' => 32,
                'slug' => 'd10q16'
            ],
            [
                'name' => 'Hand washing soap (bar or liquid)',
                'domain_id' => 10,
                'subdomain_id' => 32,
                'slug' => 'd10q17'
            ],
            [
                'name' => 'ဆေးအဝင်အထွက်၊ လက်ကျန်စာရင်းများ မှတ်တမ်းတင်ရန် Stock Ledger (P1) ဆေးမှတ်တမ်းလယ်ဂျာစာအုပ်ကို အသုံးပြုပါသလား။',
                'domain_id' => 10,
                'subdomain_id' => 31,
                'slug' => 'd10q18'
            ],
            [
                'name' => 'နေ့စဉ်ဆေးသုံးစွဲမှုကို မှတ်တမ်းတင်ရန် Daily Drug Use Form (P3) နေ့စဉ်သုံးဆေးစာရင်း ကို အသုံးပြုပါသလား။',
                'domain_id' => 10,
                'subdomain_id' => 31,
                'slug' => 'd10q19'
            ],
            [
                'name' => 'ဆေးသုံးစွဲမှုနှင့် လက်ကျန်စာရင်းများအား ပေးပို့ရန် Monthly Physical Stock Report (P4) ဆေးအသုံးပြုမူလစဉ် အစီရင်ခံစာ အားအသုံးပြုပါသလား။',
                'domain_id' => 10,
                'subdomain_id' => 31,
                'slug' => 'd10q20'
            ],
            [
                'name' => 'စင်ပေါ်တွင်ထားရှိသောဆေး/ပစ္စည်း (၄) မျိုးကို ရွေးချယ်၍ First Expiry First Out (FEFO) သက်တမ်းကုန်ရက်နီးသော ဆေး/ပစ္စည်းများအား ဦးစားပေး ထားရှိ အသုံးပြုမှု ရှိ /မရှိ စစ်ဆေးပါ။',
                'domain_id' => 10,
                'subdomain_id' => 31,
                'slug' => 'd10q21'
            ],
            [
                'name' => 'Batch number (ဆေး/ဆေးပစ္စည်းထုတ်လုပ်သော ကုမ္မဏီမှ ဆေး/ဆေးပစ္စည်းပေါ်တွင် ရိုက်နှိပ်ထားသော အုပ်စုနံပါတ်) နှင့် သက်တမ်းကုန်ဆုံးရက် ကို stock ledger တွင် မှတ်တမ်းတင်ထားရှိ ခြင်းရှိပါသလား။',
                'domain_id' => 10,
                'subdomain_id' => 31,
                'slug' => 'd10q22'
            ],
            [
                'name' => 'နေ့စဉ်သုံးဆေးစာရင်း နှင့် ဆေးအသုံးပြုမှု လစဉ် အစီရင်ခံစာ ကိုက်ညီမှုရှိပါသလား။ အသုံးများသော ဆေး (၅)မျိုးအား စစ်ဆေးပါ။',
                'domain_id' => 10,
                'subdomain_id' => 31,
                'slug' => 'd10q23'
            ],
            [
                'name' => 'ဆေးဝါးပစ္စည်းများကို စနစ်တကျ သိမ်းဆည်းသိုလှောင်ခြင်း နှင့် ဆေးခန်းစွန့်ပစ်အမှိုက်များ ကိုစနစ်တကျ စီမံခန့်ခွဲခြင်းအတွက် လမ်းညွှန်ချက်များ‌ ထားရှိ လိုက်နာမူရှိပါသလား။',
                'domain_id' => 10,
                'subdomain_id' => 32,
                'slug' => 'd10q24'
            ],
            [
                'name' => 'ဆေးဝါးထားသိုသောနေရာ မှာ သန့်ရှင်း၊ သပ်ရပ်မှု၊ ကြွက်နှင့်ပိုးမွှား ကင်းစင်မူ ရှိပါသလား။',
                'domain_id' => 10,
                'subdomain_id' => 32,
                'slug' => 'd10q25'
            ],
            [
                'name' => 'ဆေးဝါးထားသိုသောနေရာ မှာ ခြောက်သွေ့ပြီး နေ‌ရောင်ခြည်  တိုက်ရိုက်ကျရောက်ခြင်းကိုကာကွယ်ထားရှိပါသလား။ (မိုးရေယိုစိမ့်ခြင်း၊ နံရံများစိုထိုင်းနေခြင်း၊ နေရောင်ခြည် တိုက်ရိုက်ကျရောက်ခြင်းကို စစ်ဆေးပါ)',
                'domain_id' => 10,
                'subdomain_id' => 32,
                'slug' => 'd10q26'
            ],
            [
                'name' => 'ဆေးနှင့်‌ဆေးပစ္စည်းများအားလုံးကို စင်/ဗီရို များပေါ်တွင် စနစ်တကျထားရှိပါသလား။',
                'domain_id' => 10,
                'subdomain_id' => 32,
                'slug' => 'd10q27'
            ],
            [
                'name' => 'ဆေးသိုလှောင်ခန်းအား အနည်းဆုံးတစ်နေ့ (၂)ကြိမ် အပူချိန်တိုင်းတာ၍ မှတ်တမ်းတင်ထားရှိပါသလား။',
                'domain_id' => 10,
                'subdomain_id' => 32,
                'slug' => 'd10q28'
            ],
            [
                'name' => 'Infant weighing scale that is accessible',
                'domain_id' => 10,
                'subdomain_id' => 31,
                'slug' => 'd10q29'
            ],
            [
                'name' => 'Adult standing scale that is accessible',
                'domain_id' => 10,
                'subdomain_id' => 31,
                'slug' => 'd10q30'
            ],
            [
                'name' => 'Thermometer (အပူချိန်တိုင်းကိရိယာ)',
                'domain_id' => 10,
                'subdomain_id' => 31,
                'slug' => 'd10q31'
            ],
            [
                'name' => 'Watch or other timing device with second hand (စက္ကန့်လက်တံပါသော နာရီ)',
                'domain_id' => 10,
                'subdomain_id' => 31,
                'slug' => 'd10q32'
            ],
            [
                'name' => 'Autoclave containing pressure gauge for disinfection',
                'domain_id' => 10,
                'subdomain_id' => 31,
                'slug' => 'd10q33'
            ],
            [
                'name' => 'Glucometer Device for blood glucose monitoring',
                'domain_id' => 10,
                'subdomain_id' => 31,
                'slug' => 'd10q34'
            ],
            [
                'name' => 'Sterilized package - Dressing',
                'domain_id' => 10,
                'subdomain_id' => 31,
                'slug' => 'd10q35'
            ],
            [
                'name' => 'Sterilized package - Delivery',
                'domain_id' => 10,
                'subdomain_id' => 31,
                'slug' => 'd10q36'
            ],
            [
                'name' => 'Blood pressure machine',
                'domain_id' => 10,
                'subdomain_id' => 31,
                'slug' => 'd10q37'
            ],
            [
                'name' => 'Infant weighing scale that is accessible',
                'domain_id' => 10,
                'subdomain_id' => 32,
                'slug' => 'd10q38'
            ],
            [
                'name' => 'Adult standing scale that is accessible',
                'domain_id' => 10,
                'subdomain_id' => 32,
                'slug' => 'd10q39'
            ],
            [
                'name' => 'Thermometer (အပူချိန်တိုင်းကိရိယာ)',
                'domain_id' => 10,
                'subdomain_id' => 32,
                'slug' => 'd10q40'
            ],
            [
                'name' => 'Watch or other timing device with second hand (စက္ကန့်လက်တံပါသော နာရီ)',
                'domain_id' => 10,
                'subdomain_id' => 32,
                'slug' => 'd10q41'
            ],
            [
                'name' => 'Autoclave containing pressure gauge for disinfection',
                'domain_id' => 10,
                'subdomain_id' => 32,
                'slug' => 'd10q42'
            ],
            [
                'name' => 'Glucometer Device for blood glucose monitoring',
                'domain_id' => 10,
                'subdomain_id' => 32,
                'slug' => 'd10q43'
            ],
            [
                'name' => 'Sterilized package - Dressing',
                'domain_id' => 10,
                'subdomain_id' => 32,
                'slug' => 'd10q44'
            ],
            [
                'name' => 'Sterilized package - Delivery',
                'domain_id' => 10,
                'subdomain_id' => 32,
                'slug' => 'd10q45'
            ],
            [
                'name' => 'Blood pressure machine',
                'domain_id' => 10,
                'subdomain_id' => 32,
                'slug' => 'd10q46'
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
