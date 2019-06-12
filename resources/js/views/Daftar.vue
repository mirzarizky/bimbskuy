<template>
  <v-app id="registration" class="primary">
    <v-content>
      <v-container fluid fill-height>
        <v-layout align-center justify-center row wrap>
          <v-flex xs12 lg8>
            <v-form>
              <v-stepper v-model="currentStep" vertical>
                <v-stepper-step :complete="currentStep > 1" step="1">
                  Biodata
                  <small>Mahasiswa dan Orang tua</small>
                </v-stepper-step>

                <v-stepper-content step="1">
                  <v-card flat>
                    <v-layout row wrap justify-space-between>
                      <v-flex xs12 sm12 px-3>
                        <v-text-field
                          v-model="nama"
                          v-validate="'required|max:100'"
                          name="nama"
                          box
                          data-vv-name="nama lengkap"
                          :error-messages="errors.collect('step1.nama lengkap')"
                          data-vv-scope="step1"
                          label="Nama Lengkap"
                          required
                          validate-on-blur
                        />
                      </v-flex>
                      <v-flex xs12 sm6 px-3>
                        <v-text-field
                          v-model="email"
                          v-validate="'required|email'"
                          data-vv-name="email"
                          :error-messages="errors.collect('step1.email')"
                          data-vv-scope="step1"
                          box
                          type="email"
                          name="email"
                          label="Alamat Email"
                          required
                        />
                      </v-flex>
                      <v-flex xs12 sm6 px-3>
                        <v-text-field
                          v-model="hp_mahasiswa"
                          v-validate="'required|numeric|max:15|min:11'"
                          data-vv-name="nomor telepon"
                          :error-messages="errors.collect('step1.nomor telepon')"
                          data-vv-scope="step1"
                          box
                          label="Nomor Telepon"
                          prefix="+62"
                          required
                        />
                      </v-flex>
                      <v-flex xs12 sm6 px-3>
                        <v-text-field
                          v-model="nim"
                          v-validate="'required|numeric|max:15|min:14'"
                          data-vv-name="nim"
                          :error-messages="errors.collect('step1.nim')"
                          data-vv-scope="step1"
                          box
                          label="NIM"
                          required
                        />
                      </v-flex>
                      <v-flex xs12 sm6 px-3>
                        <v-text-field
                          v-model="hp_ortu"
                          v-validate="'required|numeric|max:15|min:11'"
                          data-vv-name="nomor telepon orang tua"
                          :error-messages="errors.collect('step1.nomor telepon orang tua')"
                          data-vv-scope="step1"
                          box
                          label="Nomor Telepon Orang Tua"
                          prefix="+62"
                          required
                        />
                      </v-flex>
                      <v-flex xs12 sm12 px-3>
                        <v-textarea
                          v-model="alamat_kos"
                          v-validate="'required|max:255'"
                          auto-grow
                          box
                          data-vv-name="alamat tinggal"
                          :error-messages="errors.collect('step1.alamat tinggal')"
                          data-vv-scope="step1"
                          label="Alamat Tinggal"
                          rows="2"
                          required
                        />
                      </v-flex>
                      <v-flex xs12 sm12 px-3 mb-1>
                        <v-textarea
                          v-model="alamat_ortu"
                          v-validate="'required|max:255'"
                          auto-grow
                          box
                          data-vv-name="alamat tinggal orang tua"
                          :error-messages="errors.collect('step1.alamat tinggal orang tua')"
                          data-vv-scope="step1"
                          label="Alamat Tinggal Orang Tua"
                          rows="1"
                          :disabled="sameAsAlamat"
                          required
                        />
                        <v-switch
                          v-model="sameAsAlamat"
                          class="mt-1 pt-1"
                          label="Sama dengan Alamat Tinggal"
                          required
                        />
                      </v-flex>
                    </v-layout>
                    <v-card-actions>
                      <v-btn color="primary" @click="validateStep('step1')">
                        Continue
                      </v-btn>
                    </v-card-actions>
                  </v-card>
                </v-stepper-content>

                <v-stepper-step :complete="currentStep > 2" step="2">
                  Tipe Bimbingan
                  <small>Skripsi atau PKL</small>
                </v-stepper-step>

                <v-stepper-content step="2">
                  <v-card flat>
                    <v-layout row wrap justify-center>
                      <v-flex xs12 sm6 pa-3 align-self-center>
                        <v-badge v-model="showBadges.skripsi" overlap color="primary">
                          <template v-slot:badge>
                            <v-icon dark small>
                              done
                            </v-icon>
                          </template>
                          <v-btn block depressed large :outline="showBadges.skripsi" @click="selectBimbingan(1)">
                            Skripsi
                          </v-btn>
                        </v-badge>
                        <v-badge v-model="showBadges.pkl" overlap color="primary">
                          <template v-slot:badge>
                            <v-icon dark small>
                              done
                            </v-icon>
                          </template>
                          <v-btn block depressed large :outline="showBadges.pkl" @click="selectBimbingan(2)">
                            PKL
                          </v-btn>
                        </v-badge>
                      </v-flex>
                      <v-flex sm12 px-3>
                        <v-text-field
                          v-model="judul_bimbingan"
                          label="Judul Skripsi/PKL"
                        />
                      </v-flex>
                    </v-layout>
                    <v-card-actions>
                      <v-btn color="primary" @click="currentStep = 3">
                        Continue
                      </v-btn>

                      <v-btn flat @click="currentStep = 1">
                        Kembali
                      </v-btn>
                    </v-card-actions>
                  </v-card>
                </v-stepper-content>

                <v-stepper-step :complete="currentStep > 3" step="3">
                  Departemen dan Dosen
                  <small>Dosen Wali dan Dosen Pembimbing</small>
                </v-stepper-step>

                <v-stepper-content step="3">
                  <v-card flat>
                    <v-layout row wrap justify-center>
                      <v-flex xs12 sm12 px-3 align-self-center>
                        <v-autocomplete
                          v-model="departemenId"
                          :loading="loadingInputDepartemen"
                          label="Departemen"
                          :items="departemens"
                          item-text="nama"
                          item-value="id"
                          autocomplete
                        />
                      </v-flex>
                      <v-flex sm12 px-3>
                        <v-autocomplete
                          v-model="selectedDosenWali"
                          label="Dosen Wali"
                          :loading="loadingInputDosen"
                          :items="dosens"
                          item-text="nama"
                          item-value="kode_wali"
                        />
                      </v-flex>
                      <v-flex sm12 px-3>
                        <v-autocomplete
                          v-model="selectedDosenPembimbing"
                          label="Dosen Pembimbing"
                          :loading="loadingInputDosen"
                          :disabled="loadingInputDosen"
                          :items="dosens"
                          item-text="nama"
                          item-value="kode_bimbing"
                        >
                          <template v-slot:append-outer>
                            <v-slide-x-transition>
                              <v-btn v-show="dosbing < 2" small icon outline @click="tambahDosbing">
                                <v-icon>
                                  add
                                </v-icon>
                              </v-btn>
                            </v-slide-x-transition>
                          </template>
                        </v-autocomplete>
                      </v-flex>
                      <v-slide-y-transition>
                        <v-flex v-show="dosenPembimbing2" sm12 px-3>
                          <v-autocomplete
                            v-model="selectedDosenPembimbing2"
                            label="Dosen Pembimbing II"
                            :loading="loadingInputDosen"
                            :disabled="loadingInputDosen"
                            :items="dosens"
                            item-text="nama"
                            item-value="kode_bimbing"
                          >
                            <template v-show="dosenPembimbing2" v-slot:append-outer>
                              <v-slide-x-transition>
                                <v-btn v-show="dosbing < 3" small icon outline @click="tambahDosbing">
                                  <v-icon>
                                    add
                                  </v-icon>
                                </v-btn>
                              </v-slide-x-transition>
                              <v-slide-x-transition>
                                <v-btn v-show="dosbing < 3" small icon outline @click="hapusDosbing">
                                  <v-icon>
                                    clear
                                  </v-icon>
                                </v-btn>
                              </v-slide-x-transition>
                            </template>
                          </v-autocomplete>
                        </v-flex>
                      </v-slide-y-transition>
                      <v-slide-y-transition>
                        <v-flex v-show="dosenPembimbing3" sm12 px-3>
                          <v-autocomplete
                            v-model="selectedDosenPembimbing3"
                            label="Dosen Pembimbing III"
                            :loading="loadingInputDosen"
                            :disabled="loadingInputDosen"
                            :items="dosens"
                            item-text="nama"
                            item-value="kode_bimbing"
                            persistent-hint
                            hint="Maksimum Dosen Pembimbing adalah 3"
                          >
                            <template v-slot:append-outer>
                              <v-slide-x-transition>
                                <v-btn v-show="dosenPembimbing3" small icon outline @click="hapusDosbing">
                                  <v-icon>
                                    clear
                                  </v-icon>
                                </v-btn>
                              </v-slide-x-transition>
                            </template>
                          </v-autocomplete>
                        </v-flex>
                      </v-slide-y-transition>
                      <!--<v-flex>-->
                      <!--<v-btn small depressed :disabled="dosbing > 2" class="mx-2" color="accent" @click="tambahDosbing">-->
                      <!--tambah dosen pembimbing-->
                      <!--</v-btn>-->
                      <!--<v-slide-x-transition>-->
                      <!--<v-btn v-show="dosenPembimbing2" small depressed class="mx-2" @click="hapusDosbing">-->
                      <!--hapus dosen pembimbing-->
                      <!--</v-btn>-->
                      <!--</v-slide-x-transition>-->
                      <!--</v-flex>-->
                    </v-layout>
                    <v-card-actions>
                      <v-btn color="primary" @click="currentStep = 4">
                        Lanjutkan
                      </v-btn>
                      <v-btn flat @click="currentStep = 2">
                        Kembali
                      </v-btn>
                    </v-card-actions>
                  </v-card>
                </v-stepper-content>

                <v-stepper-step step="4">
                  Foto & KRS
                </v-stepper-step>

                <v-stepper-content step="4">
                  <!--<v-card class="mb-5" color="grey lighten-1" height="200px" />-->
                  <registration-upload-form />

                  <v-btn color="primary" @click="currentStep = 1">
                    Continue
                  </v-btn>

                  <v-btn flat @click="currentStep = 3">
                    Cancel
                  </v-btn>
                </v-stepper-content>
              </v-stepper>
            </v-form>
          </v-flex>
          <v-flex xs12 sm12 lg12 align-self-center class="my-3">
            <router-link to="/login">
              <p class="text-xs-center">
                Saya sudah punya akun
              </p>
            </router-link>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
  import axios from "@/api";
  import RegistrationUploadForm from "@/components/RegistrationUpload.vue"

  export default {
    components: {
      RegistrationUploadForm
    },
    data: () => ({
      currentStep: 1,
      sameAsAlamat: false,
      nama: "",
      email: "",
      nim: "",
      hp_mahasiswa: "",
      hp_ortu: "",
      alamat_kos: "",
      alamat_ortu: "",
      tipe_bimbingan: "",
      judul_bimbingan:"",
      showBadges: {
        skripsi: false,
        pkl: false,
      },
      departemens: [],
      departemenId: "",
      dosens: [],
      selectedDosenWali: "",
      selectedDosenPembimbing: "",
      selectedDosenPembimbing2: "",
      selectedDosenPembimbing3: "",
      dosenPembimbing2: false,
      dosenPembimbing3: false,
      dosbing: 1,
      loadingInputDepartemen: false,
      loadingInputDosen: false,
    }),
    watch: {
      departemenId: function(id) {
        if(id) {
          this.selectDepartemen(id);
          this.getDosenByDepartemenId(id)
        }
      },
      sameAsAlamat: function() {
        if(this.sameAsAlamat) {
          this.alamat_ortu = this.alamat_kos;
        }
        else {
          this.alamat_ortu = "";
        }
      },
      alamat_kos: function() {
        if(this.sameAsAlamat) {
          this.alamat_ortu = this.alamat_kos;
        }
      }
    },
    created() {
      this.getAllDepartemen();
      // console.log(this.$refs.pond)
    },
    methods: {
      selectBimbingan: function(tipe) {
        if(tipe === 1) {
          this.showBadges.pkl = false;
          this.showBadges.skripsi = true;
          this.tipe_bimbingan = 1;
        }
        else {
          this.showBadges.skripsi = false;
          this.showBadges.pkl = true;
          this.tipe_bimbingan = 2;
        }
      },
      getAllDepartemen: function() {
        axios.get("departemen")
          .then(response => {
            this.loadingInputDepartemen = true;
            this.departemens = response.data;
          })
          .catch(error => {
            console.error(error)
          })
          .finally(() => {
            this.loadingInputDepartemen = false;
          })
      },
      selectDepartemen: function(id) {
        console.log(id)
      },
      getDosenByDepartemenId: function(id) {
        this.loadingInputDosen = true;
        axios.get('dosen/'+id+'/departemen')
          .then(response => {
            this.dosens = response.data;
          })
          .catch(error => {
            console.log(error)
          })
          .finally(() => {
            this.loadingInputDosen = false;
          })
      },
      tambahDosbing:function() {
        if(this.dosbing === 1) {
          this.dosbing++;
          this.dosenPembimbing2 = true;
        }
        else if(this.dosbing === 2) {
          this.dosbing++;
          this.dosenPembimbing3 = true;
        }
      },
      hapusDosbing:function() {
        if(this.dosbing === 2) {
          this.dosenPembimbing2 = false;
          this.selectedDosenPembimbing2 = "";
          this.dosbing--;
        }
        else if(this.dosbing === 3) {
          this.dosenPembimbing3 = false;
          this.selectedDosenPembimbing3 = "";
          this.dosbing--;
        }
      },
      clearDosenInput: function() {
        this.selectedDosenWali = "";
        this.selectedDosenPembimbing = "";
        this.selectedDosenPembimbing2 = "";
        this.selectedDosenPembimbing3 = "";
      },
      validateStep: function(scope) {
        this.$validator.validateAll(scope).then(result => {
          if (result) {
            this.currentStep++;
          }
        });
      }
    },
  };
</script>

<style scoped lang="css">
#registration {
  height: 50%;
  width: 100%;
  position: absolute;
  top: 0;
  left: 0;
  content: "";
  z-index: 0;
}
</style>
