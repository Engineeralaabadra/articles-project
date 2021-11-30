<template>
  <div>
    <navigate />
    <div class="container">
      <v-snackbar v-model="snackbar" :color="color">
        {{ text }}
        <template v-slot:action="{ attrs }">
          <v-btn color="pink" text v-bind="attrs" @click="snackbar = false">
            Close
          </v-btn>
        </template>
      </v-snackbar>
      <div class="row">
        <div class="col-sm-11 mx-auto row mt-5">
          <v-alert
            class="col-sm-12 mx-auto white--text font-2 text-center"
            color="black"
          >
            <i class="far fa-list-alt ml-3"></i> إدارة المقالات
          </v-alert>
          <v-data-table
            :headers="headers"
            :items="articles"
            :search="search"
            :items-per-page="5"
            item-key="name"
            sort-by="name"
            class="elevation-1 col-sm-12"
          >
            <template v-slot:item.status="{ item }">
              <v-chip :color="getColor(item.status)" dark>{{
                item.status
              }}</v-chip>
            </template>
            <template v-slot:top>
              <v-toolbar flat color="white">
                <v-text-field
                  v-model="search"
                  append-icon="mdi-magnify"
                  label="البحث"
                  class="col-sm-5 ml-auto mt-4 mb-4"
                  single-line
                  hide-details
                ></v-text-field>
                <v-dialog v-model="dialog">
                  <template v-slot:activator="{ on, attrs }">
                    <v-btn
                      color="primary"
                      dark
                      class=""
                      v-bind="attrs"
                      v-on="on"
                      icon
                      ><i class="far fa-plus-square font-3 black--text"></i
                    ></v-btn>
                  </template>

                  <v-card class="col-sm-7 mx-auto">
                    <v-card-title>
                      <v-alert
                        class="col-sm-12 mx-auto white--text font-2 text-center"
                        color="black"
                      >
                        <i class="far list-alt ml-3"></i> إدارة المقال
                      </v-alert>
                    </v-card-title>
                    <v-card-text>
                      <div class="row">
                        <v-text-field
                          class="col-sm-5 ml-auto"
                          outlined
                          dense
                          label="عنوان المقال"
                          v-model="editedItem.title"
                        ></v-text-field>
                        <v-text-field
                          class="col-sm-5 mr-auto"
                          outlined
                          dense
                          label="موضوع المقال"
                          v-model="editedItem.body"
                        ></v-text-field>
                        <v-autocomplete
                          :items="status"
                          class="col-sm-5 ml-auto"
                          outlined
                          dense
                          label="الحالة"
                          v-model="editedItem.status"
                        >
                        </v-autocomplete>
                        <div class="col-sm-5 mr-auto"></div>
                        <div class="col-sm-5 mx-auto row">
                          <v-tooltip top>
                            <template v-slot:activator="{ on, attrs }">
                              <v-btn
                                fab
                                v-bind="attrs"
                                v-on="on"
                                size="24"
                                class="mx-auto"
                                color="blue darken-3"
                                dark
                                @click="save()"
                              >
                                <v-icon>mdi-content-save-all</v-icon>
                              </v-btn>
                            </template>
                            <span>حفظ</span>
                          </v-tooltip>
                          <v-tooltip top>
                            <template v-slot:activator="{ on, attrs }">
                              <v-btn
                                fab
                                v-bind="attrs"
                                v-on="on"
                                size="24"
                                class="mx-auto"
                                color="amber darken-3"
                                dark
                                @click="close()"
                              >
                                <v-icon>mdi-reply-all</v-icon>
                              </v-btn>
                            </template>
                            <span>رجوع</span>
                          </v-tooltip>
                        </div>
                      </div>
                    </v-card-text>
                  </v-card>
                </v-dialog>
              </v-toolbar>
            </template>
            <template v-slot:item.actions="{ item }">
              <v-btn icon small @click="editItem(item)">
                <i class="fas fa-edit"></i>
              </v-btn>
              <v-btn icon small @click="deleteItem(item)">
                <i class="fas fa-trash-alt"></i>
              </v-btn>
            </template>
            <template v-slot:no-data>
              <v-btn color="primary" @click="initialize">Reset</v-btn>
            </template>
          </v-data-table>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import navigate from "../../../components/navigate";
export default {
  name: "managebrand",
  components: {
    navigate,
  },
  data() {
    return {
      ErrorBool: false,
      SuccessBool: false,
      Errors: [],
      Success: [],
      ErrorMessage: {
        500: "Occured Error in server side to show Result Data ! Try again",
        404: "Somthing Not Found In Result Data ! Try again",
        400: "You Can not make this , try again in your entering ",
        401: "You UnAuthorized to see Result Data ! Login ,pls",
        405: "Somthing Not Allow to show Result Data ! Try again",
        403: "There is a supplier but until now not supply any store",
        419: "Somthing Unknown In Result Data ! Try again",
        "No Data In Your Entering":
          "There is No Data in Your DataBase to show it",
        "No Data To Show It":
          "There is No Data in Something in Show The Result",
        "No Data Tasks": "There is No Tasks For This User to  Show it",
        "No Data Events": "There is No Event For This User to  Show it",
        Else: "Occured Somthing Error  to show Result Data ! Try again",
      },
      status: ["متوفر", "غير متوفر"],
      search: "",
      dialog: false,
      headers: [
        {
          text: "عنوان المقال",
          align: "start",
          sortable: true,
          value: "title",
        },
        { text: "موضوع المقال", value: "subject" },
        { text: "الحالة", value: "status" },
        { text: "تعديل وحذف", value: "actions", sortable: false },
      ],
      articles: [],
      editedIndex: -1,
      editedItem: {
        title: "",
        body: "",
        status: "",
      },
      defaultItem: {
        title: "",
        body: "",
        status: "",
      },
    };
  },

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
  },

  created() {
    this.initialize();
  },

  methods: {
    getError(id) {
      if (this.ErrorMessage.hasOwnProperty(id)) return this.ErrorMessage[id];
    },
    callSuccessMessage(msg) {
      this.Success = [];
      return this.Success.push(msg);
    },
    noDataInYourEntering() {
      this.Errors = [];
      (this.ErrorBool = true),
        this.Errors.push("No Data In Your Entering"),
        () =>
          setTimeout(() => {
            this.ErrorBool = false;
          }, 3000);
    },
    noDataInSomethingResult() {
      this.Errors = [];
      (this.ErrorBool = true),
        this.Errors.push("No Data To Show It"),
        () =>
          setTimeout(() => {
            this.ErrorBool = false;
          }, 3000);
    },
    callErrorMessage(statusErr) {
      if (
        statusErr == 404 ||
        statusErr == 401 ||
        statusErr == 500 ||
        statusErr == 419 ||
        statusErr == 400 ||
        statusErr == 405 ||
        statusErr == 403
      ) {
        this.Errors = [];
        this.Errors.push(statusErr);
      } else {
        this.Errors = [];
        this.Errors.push("Else");
      }
    },
    getColor(status) {
      if (status == "غير متوفر") return "red";
      else if (status == "متوفر") return "green";
    },
    initialize() {
      axios
        .get("http://127.0.0.1:8080/api/admin/articles/index")
        .then((res) => {
          console.log("yyyy", res);

          if (res.data.length != 0) {
            res.data.forEach((item) => {
              this.articles.push(item);
            });
          } else {
            this.noDataInYourEntering();
          }
        })
        .catch((err) => {
          console.log("uuuu", err.response.data.status);
          if (err.response.data.status == 400) {
            this.noDataInSomethingResult();
          } else if (err.response.data.status == 401) {
            this.callErrorMessage(res.data.status);
          } else {
            this.callErrorMessage("Else");
          }
        });
    },

    editItem(item) {
      this.editedIndex = this.articles.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.articles.indexOf(item);
      this.$dialog
        .confirm("هل أنت متأكدأنك تريح مسح هذا العنصر!")
        .then((dialog) => {
          axios
            .get(
              `http://127.0.0.1:8080/api/admin/articles/destroy/${this.editedItem.id}`
            )
            .then((res) => {
              if (res.data.status == 404) {
                this.noDataInSomethingResult();
              } else if (res.data.status == 401) {
                this.callErrorMessage(res.data.status);
              } else if (res.data.status == 400) {
                this.callErrorMessage(res.data.status);
              } else {
                if (res.data.message != null) {
                  this.callSuccessMessage(res.data.message);
                } else {
                  this.noDataInYourEntering();
                }
              }
            })
            .catch((err) => {
              if (err.response.data.status == 400) {
                this.noDataInSomethingResult();
              } else if (err.response.data.status == 401) {
                this.callErrorMessage(res.data.status);
              } else {
                this.callErrorMessage("Else");
              }
            });
        });
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.articles[this.editedIndex], this.editedItem);
        axios
          .post(
            `http://127.0.0.1:8080/api/admin/articles/update/${this.editedItem.id}`,
            {
              title: this.editedItem.title,
              body: this.editedItem.body,
              status: this.editedItem.status,
            }
          )
          .then((res) => {
            console.log("fff", res);
            if (res.data.status == 404) {
              this.noDataInSomethingResult();
            } else if (res.data.status == 401) {
              this.callErrorMessage(res.data.status);
            } else if (res.data.status == 400) {
              this.callErrorMessage(res.data.status);
            } else {
              if (res.data.message != null) {
                this.callSuccessMessage(res.data.message);
              } else {
                this.noDataInYourEntering();
              }
            }
          })
          .catch((err) => {
            if (err.response.data.status == 400) {
              this.noDataInSomethingResult();
            } else if (err.response.data.status == 401) {
              this.callErrorMessage(res.data.status);
            } else {
              this.callErrorMessage("Else");
            }
          });
      } else {
        this.articles.push(this.editedItem);
        axios
          .post("http://127.0.0.1:8080/api/admin/articles/store", {
            title: this.editedItem.title,
            body: this.editedItem.body,
            status: this.editedItem.status,
          })
          .then((res) => {
            console.log("fff", res);
            if (res.data.status == 404) {
              this.noDataInSomethingResult();
            } else if (res.data.status == 401) {
              this.callErrorMessage(res.data.status);
            } else if (res.data.status == 400) {
              this.callErrorMessage(res.data.status);
            } else {
              if (res.data.message != null) {
                this.callSuccessMessage(res.data.message);
              } else {
                this.noDataInYourEntering();
              }
            }
          })
          .catch((err) => {
            if (err.response.data.status == 400) {
              this.noDataInSomethingResult();
            } else if (err.response.data.status == 401) {
              this.callErrorMessage(res.data.status);
            } else {
              this.callErrorMessage("Else");
            }
          });
      }
      this.close();
    },
  },
};
</script>
