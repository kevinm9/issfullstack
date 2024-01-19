<template>
  <div class="bg-blue-50 p-d-flex p-flex-column full-height-container">

    <div class="px-4 md:px-6 lg:px-8 ">
      <div class="text-center mb-3">
        <div class="font-bold text-5xl mb-3 text-primary">Registro</div>
        <div class="text-1xl ">Comienza tu periodo de prueba gratuito en solo 3 pasos.</div>
        <div class="text-1xl font-bold">No es necesario agregar tarjeta de crédito.</div>
      </div>
    </div>

    <div class="col-12 md:mx-auto md:col-8 ">
      <transition-group name="p-message" tag="div">
        <Message v-for="error of messages" :key="error.$uid" severity="error">{{ error.$property }} es requirido
        </Message>
      </transition-group>
      <form @submit.prevent="onSubmit">
        <Card>
          <template #content>
            <h1 class=" text-2xl mt-0">Datos de la cuenta</h1>
            <div class="p-fluid formgrid grid ml-0">
              <div class="field col-12">
                <span class="p-float-label">
                  <InputText :class="{ 'border-round-3xl': true, 'p-invalid': v$.nombrenegocio.$error }"
                    id="nombreNegocio" v-model="formData.nombrenegocio" />
                  <label for="nombreNegocio">Nombre del negocio</label>
                  <span class="text-red-600" v-if="v$.nombrenegocio.$error">
                    Escriba el nombre de su negocio
                  </span>
                </span>
              </div>
              <div class="field col-12">
                <span class="p-float-label">
                  <Dropdown filter :class="{ 'border-round-3xl': true, 'p-invalid': v$.industria.$error }" v-model="formData.industria" :options="industrias" optionLabel="nombre" optionValue="id"
                    placeholder="Seleccione tu industria" />
                  <label for="industria">Seleccione tu industria</label>
                  <span class="text-red-600" v-if="v$.industria.$error">
                    seleccione una industria de su negocio
                  </span>
                </span>
              </div>
            </div>
            <h5 class=" text-2xl my-2">Datos del administrador</h5>
            <div class="p-fluid formgrid grid ml-0">
              <div class="field col-12 md:col-6">
                <span class="p-float-label">
                  <InputText :class="{ 'border-round-3xl': true, 'p-invalid': v$.nombre.$error }" id="nombreAdmin"
                    v-model="formData.nombre" />
                  <label for="nombreAdmin">Nombre</label>
                </span>
              </div>
              <div class="field col-12 md:col-6">
                <span class="p-float-label">
                  <InputText :class="{ 'border-round-3xl': true, 'p-invalid': v$.apellido.$error }" id="apellidoAdmin"
                    v-model="formData.apellido" />
                  <label for="apellidoAdmin">Apellido</label>
                </span>
              </div>
              <div class="field col-12 md:col-4">
                <span class="p-float-label">
                  <Dropdown :class="{ 'border-round-3xl': true, 'p-invalid': v$.selectedCountry.$error }"
                    v-model="formData.selectedCountry" :options="countries" optionLabel="text"
                    placeholder="Select a Country">
                    <template #value="slotProps">
                      <div v-if="slotProps.value" class="flex align-items-center">
                        <img :alt="slotProps.value.label"
                          src="https://primefaces.org/cdn/primevue/images/flag/flag_placeholder.png"
                          :class="`mr-2 flag flag-${slotProps.value.id.toLowerCase()}`" style="width: 18px" />
                        <div>{{ slotProps.value.text }}</div>
                      </div>
                      <span v-else>
                        {{ slotProps.placeholder }}
                      </span>
                    </template>
                    <template #option="slotProps">
                      <div class="flex align-items-center">
                        <img :alt="slotProps.option.text"
                          src="https://primefaces.org/cdn/primevue/images/flag/flag_placeholder.png"
                          :class="`mr-2 flag flag-${slotProps.option.id.toLowerCase()}`" style="width: 18px" />
                        <div>{{ slotProps.option.text }}</div>
                      </div>
                    </template>
                  </Dropdown>
                  <label for="ciudad">Pais</label>
                  <span class="text-red-600" v-if="v$.selectedCountry.$error">
                    Seleccione un pais
                  </span>
                </span>
              </div>
              <div class="field col-12 md:col-8">
                <span class="p-float-label">
                  <InputText :class="{ 'border-round-3xl': true, 'p-invalid': v$.celular.$error }" id="numeroAdmin"
                    v-model="formData.celular" />
                  <label for="numeroAdmin">Numero</label>
                </span>
              </div>
              <div class="field col-12">
                <span class="p-float-label">
                  <InputText @blur="v$.correo.$touch" :class="{ 'border-round-3xl': true, 'p-invalid': v$.correo.$error }"
                    id="correoAdmin" v-model="formData.correo" />
                  <label for="correoAdmin">Correo</label>
                  <span class="text-red-600" v-if="v$.correo.$errors[0]?.$validator == 'required'">
                    Escriba su correo por favor.
                  </span>
                  <span class="text-red-600" v-if="v$.correo.$errors[0]?.$validator == 'email'">
                    Escriba un correo valido.
                  </span>
                </span>
              </div>
            </div>
          </template>
          <template #footer>
            <div class="
              flex flex-wrap
              justify-content-end
              gap-3
              mt-3
            ">
              <Button class="bg-teal-500 border-round-3xl p-button-rounded" type="submit" label="Siguiente"
                icon="pi pi-chevron-right" size="small" iconPos="right" />
            </div>
          </template>
        </Card>
      </form>
    </div>

    <Toast />

  </div>
</template>

<script setup>
import { ref, onMounted, reactive, computed ,toRefs } from 'vue';
import { useVuelidate } from '@vuelidate/core';
import { required, email } from '@vuelidate/validators';
import axios from 'axios';
import { useToast } from 'primevue/usetoast';
const toast = useToast();
//datos formulario reactivo por q esun obj
const formData = reactive({
  nombrenegocio: 'TVCABLE',
  industria: null,
  nombre: 'kevin',
  apellido: 'mosquera',
  celular: '09879810',
  correo: 'kievin@gfd.com',
  selectedCountry: { "id": "EC", "text": "Ecuador" },
});
const rules = computed(() => {
  return {
    nombrenegocio: { required },
    industria: { required },
    nombre: { required },
    apellido: { required },
    selectedCountry: { required },
    celular: { required },
    correo: { required, email },
  }
});
const v$ = useVuelidate(rules, formData);
const messages = ref([]);
const industrias = ref([]);
const countries = ref([
  { id: 'AF', text: 'Afghanistan' },
  { id: 'AX', text: 'Aland Islands' },
  { id: 'AL', text: 'Albania' },
  { id: 'DZ', text: 'Algeria' },
  { id: 'AS', text: 'American Samoa' },
  { id: 'AD', text: 'Andorra' },
  { id: 'AO', text: 'Angola' },
  { id: 'AI', text: 'Anguilla' },
  { id: 'AQ', text: 'Antarctica' },
  { id: 'AG', text: 'Antigua And Barbuda' },
  { id: 'AR', text: 'Argentina' },
  { id: 'AM', text: 'Armenia' },
  { id: 'AW', text: 'Aruba' },
  { id: 'AU', text: 'Australia' },
  { id: 'AT', text: 'Austria' },
  { id: 'AZ', text: 'Azerbaijan' },
  { id: 'BS', text: 'Bahamas' },
  { id: 'BH', text: 'Bahrain' },
  { id: 'BD', text: 'Bangladesh' },
  { id: 'BB', text: 'Barbados' },
  { id: 'BY', text: 'Belarus' },
  { id: 'BE', text: 'Belgium' },
  { id: 'BZ', text: 'Belize' },
  { id: 'BJ', text: 'Benin' },
  { id: 'BM', text: 'Bermuda' },
  { id: 'BT', text: 'Bhutan' },
  { id: 'BO', text: 'Bolivia' },
  { id: 'BA', text: 'Bosnia And Herzegovina' },
  { id: 'BW', text: 'Botswana' },
  { id: 'BV', text: 'Bouvet Island' },
  { id: 'BR', text: 'Brazil' },
  { id: 'IO', text: 'British Indian Ocean Territory' },
  { id: 'BN', text: 'Brunei Darussalam' },
  { id: 'BG', text: 'Bulgaria' },
  { id: 'BF', text: 'Burkina Faso' },
  { id: 'BI', text: 'Burundi' },
  { id: 'KH', text: 'Cambodia' },
  { id: 'CM', text: 'Cameroon' },
  { id: 'CA', text: 'Canada' },
  { id: 'CV', text: 'Cape Verde' },
  { id: 'KY', text: 'Cayman Islands' },
  { id: 'CF', text: 'Central African Republic' },
  { id: 'TD', text: 'Chad' },
  { id: 'CL', text: 'Chile' },
  { id: 'CN', text: 'China' },
  { id: 'CX', text: 'Christmas Island' },
  { id: 'CC', text: 'Cocos (Keeling) Islands' },
  { id: 'CO', text: 'Colombia' },
  { id: 'KM', text: 'Comoros' },
  { id: 'CG', text: 'Congo' },
  { id: 'CD', text: 'Congo}, Democratic Republic' },
  { id: 'CK', text: 'Cook Islands' },
  { id: 'CR', text: 'Costa Rica' },
  { id: 'CI', text: "Cote D'Ivoire" },
  { id: 'HR', text: 'Croatia' },
  { id: 'CU', text: 'Cuba' },
  { id: 'CY', text: 'Cyprus' },
  { id: 'CZ', text: 'Czech Republic' },
  { id: 'DK', text: 'Denmark' },
  { id: 'DJ', text: 'Djibouti' },
  { id: 'DM', text: 'Dominica' },
  { id: 'DO', text: 'Dominican Republic' },
  { id: 'EC', text: 'Ecuador' },
  { id: 'EG', text: 'Egypt' },
  { id: 'SV', text: 'El Salvador' },
  { id: 'GQ', text: 'Equatorial Guinea' },
  { id: 'ER', text: 'Eritrea' },
  { id: 'EE', text: 'Estonia' },
  { id: 'ET', text: 'Ethiopia' },
  { id: 'FK', text: 'Falkland Islands (Malvinas)' },
  { id: 'FO', text: 'Faroe Islands' },
  { id: 'FJ', text: 'Fiji' },
  { id: 'FI', text: 'Finland' },
  { id: 'FR', text: 'France' },
  { id: 'GF', text: 'French Guiana' },
  { id: 'PF', text: 'French Polynesia' },
  { id: 'TF', text: 'French Southern Territories' },
  { id: 'GA', text: 'Gabon' },
  { id: 'GM', text: 'Gambia' },
  { id: 'GE', text: 'Georgia' },
  { id: 'DE', text: 'Germany' },
  { id: 'GH', text: 'Ghana' },
  { id: 'GI', text: 'Gibraltar' },
  { id: 'GR', text: 'Greece' },
  { id: 'GL', text: 'Greenland' },
  { id: 'GD', text: 'Grenada' },
  { id: 'GP', text: 'Guadeloupe' },
  { id: 'GU', text: 'Guam' },
  { id: 'GT', text: 'Guatemala' },
  { id: 'GG', text: 'Guernsey' },
  { id: 'GN', text: 'Guinea' },
  { id: 'GW', text: 'Guinea-Bissau' },
  { id: 'GY', text: 'Guyana' },
  { id: 'HT', text: 'Haiti' },
  { id: 'HM', text: 'Heard Island & Mcdonald Islands' },
  { id: 'VA', text: 'Holy See (Vatican City State)' },
  { id: 'HN', text: 'Honduras' },
  { id: 'HK', text: 'Hong Kong' },
  { id: 'HU', text: 'Hungary' },
  { id: 'IS', text: 'Iceland' },
  { id: 'IN', text: 'India' },
  { id: 'ID', text: 'Indonesia' },
  { id: 'IR', text: 'Iran}, Islamic Republic Of' },
  { id: 'IQ', text: 'Iraq' },
  { id: 'IE', text: 'Ireland' },
  { id: 'IM', text: 'Isle Of Man' },
  { id: 'IL', text: 'Israel' },
  { id: 'IT', text: 'Italy' },
  { id: 'JM', text: 'Jamaica' },
  { id: 'JP', text: 'Japan' },
  { id: 'JE', text: 'Jersey' },
  { id: 'JO', text: 'Jordan' },
  { id: 'KZ', text: 'Kazakhstan' },
  { id: 'KE', text: 'Kenya' },
  { id: 'KI', text: 'Kiribati' },
  { id: 'KR', text: 'Korea' },
  { id: 'KW', text: 'Kuwait' },
  { id: 'KG', text: 'Kyrgyzstan' },
  { id: 'LA', text: "Lao People's Democratic Republic" },
  { id: 'LV', text: 'Latvia' },
  { id: 'LB', text: 'Lebanon' },
  { id: 'LS', text: 'Lesotho' },
  { id: 'LR', text: 'Liberia' },
  { id: 'LY', text: 'Libyan Arab Jamahiriya' },
  { id: 'LI', text: 'Liechtenstein' },
  { id: 'LT', text: 'Lithuania' },
  { id: 'LU', text: 'Luxembourg' },
  { id: 'MO', text: 'Macao' },
  { id: 'MK', text: 'Macedonia' },
  { id: 'MG', text: 'Madagascar' },
  { id: 'MW', text: 'Malawi' },
  { id: 'MY', text: 'Malaysia' },
  { id: 'MV', text: 'Maldives' },
  { id: 'ML', text: 'Mali' },
  { id: 'MT', text: 'Malta' },
  { id: 'MH', text: 'Marshall Islands' },
  { id: 'MQ', text: 'Martinique' },
  { id: 'MR', text: 'Mauritania' },
  { id: 'MU', text: 'Mauritius' },
  { id: 'YT', text: 'Mayotte' },
  { id: 'MX', text: 'Mexico' },
  { id: 'FM', text: 'Micronesia}, Federated States Of' },
  { id: 'MD', text: 'Moldova' },
  { id: 'MC', text: 'Monaco' },
  { id: 'MN', text: 'Mongolia' },
  { id: 'ME', text: 'Montenegro' },
  { id: 'MS', text: 'Montserrat' },
  { id: 'MA', text: 'Morocco' },
  { id: 'MZ', text: 'Mozambique' },
  { id: 'MM', text: 'Myanmar' },
  { id: 'NA', text: 'Namibia' },
  { id: 'NR', text: 'Nauru' },
  { id: 'NP', text: 'Nepal' },
  { id: 'NL', text: 'Netherlands' },
  { id: 'AN', text: 'Netherlands Antilles' },
  { id: 'NC', text: 'New Caledonia' },
  { id: 'NZ', text: 'New Zealand' },
  { id: 'NI', text: 'Nicaragua' },
  { id: 'NE', text: 'Niger' },
  { id: 'NG', text: 'Nigeria' },
  { id: 'NU', text: 'Niue' },
  { id: 'NF', text: 'Norfolk Island' },
  { id: 'MP', text: 'Northern Mariana Islands' },
  { id: 'NO', text: 'Norway' },
  { id: 'OM', text: 'Oman' },
  { id: 'PK', text: 'Pakistan' },
  { id: 'PW', text: 'Palau' },
  { id: 'PS', text: 'Palestinian Territory}, Occupied' },
  { id: 'PA', text: 'Panama' },
  { id: 'PG', text: 'Papua New Guinea' },
  { id: 'PY', text: 'Paraguay' },
  { id: 'PE', text: 'Peru' },
  { id: 'PH', text: 'Philippines' },
  { id: 'PN', text: 'Pitcairn' },
  { id: 'PL', text: 'Poland' },
  { id: 'PT', text: 'Portugal' },
  { id: 'PR', text: 'Puerto Rico' },
  { id: 'QA', text: 'Qatar' },
  { id: 'RE', text: 'Reunion' },
  { id: 'RO', text: 'Romania' },
  { id: 'RU', text: 'Russian Federation' },
  { id: 'RW', text: 'Rwanda' },
  { id: 'BL', text: 'Saint Barthelemy' },
  { id: 'SH', text: 'Saint Helena' },
  { id: 'KN', text: 'Saint Kitts And Nevis' },
  { id: 'LC', text: 'Saint Lucia' },
  { id: 'MF', text: 'Saint Martin' },
  { id: 'PM', text: 'Saint Pierre And Miquelon' },
  { id: 'VC', text: 'Saint Vincent And Grenadines' },
  { id: 'WS', text: 'Samoa' },
  { id: 'SM', text: 'San Marino' },
  { id: 'ST', text: 'Sao Tome And Principe' },
  { id: 'SA', text: 'Saudi Arabia' },
  { id: 'SN', text: 'Senegal' },
  { id: 'RS', text: 'Serbia' },
  { id: 'SC', text: 'Seychelles' },
  { id: 'SL', text: 'Sierra Leone' },
  { id: 'SG', text: 'Singapore' },
  { id: 'SK', text: 'Slovakia' },
  { id: 'SI', text: 'Slovenia' },
  { id: 'SB', text: 'Solomon Islands' },
  { id: 'SO', text: 'Somalia' },
  { id: 'ZA', text: 'South Africa' },
  { id: 'GS', text: 'South Georgia And Sandwich Isl.' },
  { id: 'ES', text: 'Spain' },
  { id: 'LK', text: 'Sri Lanka' },
  { id: 'SD', text: 'Sudan' },
  { id: 'SR', text: 'Suriname' },
  { id: 'SJ', text: 'Svalbard And Jan Mayen' },
  { id: 'SZ', text: 'Swaziland' },
  { id: 'SE', text: 'Sweden' },
  { id: 'CH', text: 'Switzerland' },
  { id: 'SY', text: 'Syrian Arab Republic' },
  { id: 'TW', text: 'Taiwan' },
  { id: 'TJ', text: 'Tajikistan' },
  { id: 'TZ', text: 'Tanzania' },
  { id: 'TH', text: 'Thailand' },
  { id: 'TL', text: 'Timor-Leste' },
  { id: 'TG', text: 'Togo' },
  { id: 'TK', text: 'Tokelau' },
  { id: 'TO', text: 'Tonga' },
  { id: 'TT', text: 'Trinidad And Tobago' },
  { id: 'TN', text: 'Tunisia' },
  { id: 'TR', text: 'Turkey' },
  { id: 'TM', text: 'Turkmenistan' },
  { id: 'TC', text: 'Turks And Caicos Islands' },
  { id: 'TV', text: 'Tuvalu' },
  { id: 'UG', text: 'Uganda' },
  { id: 'UA', text: 'Ukraine' },
  { id: 'AE', text: 'United Arab Emirates' },
  { id: 'GB', text: 'United Kingdom' },
  { id: 'US', text: 'United States' },
  { id: 'UM', text: 'United States Outlying Islands' },
  { id: 'UY', text: 'Uruguay' },
  { id: 'UZ', text: 'Uzbekistan' },
  { id: 'VU', text: 'Vanuatu' },
  { id: 'VE', text: 'Venezuela' },
  { id: 'VN', text: 'Viet Nam' },
  { id: 'VG', text: 'Virgin Islands}, British' },
  { id: 'VI', text: 'Virgin Islands}, U.S.' },
  { id: 'WF', text: 'Wallis And Futuna' },
  { id: 'EH', text: 'Western Sahara' },
  { id: 'YE', text: 'Yemen' },
  { id: 'ZM', text: 'Zambia' },
  { id: 'ZW', text: 'Zimbabwe' },
]);

//metodos
const cargarIndustrias = async () => {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/industrias');
    industrias.value = response.data;
  } catch (error) {
    console.error('Error al cargar las industrias', error);
  }
};
const onSubmit = async () => {
  messages.value = []
  const isFormCorrect = await v$.value.$validate();
  messages.value = v$.value.$errors;

  // you can show some extra alert to the user or just leave the each field to show it's `$errors`.
  if (!isFormCorrect) {
    toast.add({ severity: 'error', summary: 'Error', detail: 'Error en el formulario de registro', life: 3000 });
    return
  }
  // actually submit form
  if (isFormCorrect) {
    try {
      let objjson = JSON.parse(JSON.stringify(formData))
      const formDataCopia = { ...objjson, industria_id: objjson.industria };

      const response = await axios.post('http://127.0.0.1:8000/api/negocios', formDataCopia);

      if (response.status==201) {
        toast.add({ severity: 'success', summary: 'success', detail: 'Se guardo correctamente', life: 3000 });
      } else {
        toast.add({ severity: 'error', summary: 'Error', detail: 'Error en la conexion', life: 3000 });

      }
      console.log('Respuesta de la API:', response);
    } catch (error) {
      toast.add({ severity: 'error', summary: 'Error', detail: 'Error en la conexion', life: 3000 });
      console.log(error);
      // Puedes manejar errores específicos aquí y mostrar mensajes al usuario
    }
  }
};


onMounted(() => {
  cargarIndustrias();
});
</script>

<style module>
* {

  font-family: 'Nunito', sans-serif;
}

.color {

  background-color: #0bc798f6 !important;
  /* Código de color celeste */
}

.p-button {
  background-color: #0bc798f6 !important;
}


.myinput {
  border-radius: 4rem;
}
</style>
