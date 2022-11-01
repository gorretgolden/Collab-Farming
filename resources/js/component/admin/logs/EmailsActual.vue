<template>
  <div>
    <div v-if="emails.length > 0" class="mt-4">
      <div
        v-for="mail in emails"
        v-bind:key="mail.id"
        class="card p-4 mb-3 position-relative"
      >
        <h6 style="font-size: 13px; color: #2a2b6c">{{ mail.to }}</h6>
        <p style="font-size: 13px; color: 13px">{{ mail.title }}</p>
        <p
          style="
            position: absolute;
            right: 1.5rem;
            top: 1.5rem;
            font-size: 12px;
            color: #777;
          "
        >
          {{ formatDate(mail.created_at) }}
        </p>
        <div class="mt-2 pb-0 mb-0 cp-mail-content table-email-wrapper">
          <div v-html="mail.message"></div>
        </div>
      </div>
      <div v-if="isLoading" style="padding: 3rem 0" class="text-center">
        <span style="text-center">
          <i
            class="fas fa-spinner fa-spin text-center"
            style="font-size: 20px"
          ></i>
        </span>
      </div>
    </div>
    <div v-else style="padding: 8rem 0" class="text-center">
      <span style="text-center">
        <i
          class="fas fa-spinner fa-spin text-center"
          style="font-size: 20px"
        ></i>
      </span>
    </div>
  </div>
</template>

<script>
import moment from "moment";
import Request from "../../mixins/requestHelper";
import IziToast from "./../../mixins/IziToast";
export default {
  name: "EmailsActual",
  mixins: [IziToast],
  components: {},
  data() {
    return {
      emails: [],
      allEmails: [],
      next_link: "/api/admin/emails/actual",
      isLoading: false,
      shouldLoad: true,
    };
  },
  mounted() {
    let app = this;
    app.getData(app.next_link);
    $("#email-logs-content").scroll(function () {
      if (
        $(this)[0].offsetHeight + $(this).scrollTop() >=
        $(this)[0].scrollHeight - 50
      ) {
        if (app.shouldLoad) {
          setTimeout(function () {
            app.getData(app.next_link);
          }, 2000);
        }
      }
    });
  },
  methods: {
    getData(link) {
      let app = this;
      app.isLoading = false;

      Request.getMethod(link)
        .then((response) => {
          //console.log(response.data.data, 'first abcb')
          app.allEmails.push(...response.data.data);

          app.emails = [...new Set(app.allEmails)];
          if (response.data.next_page_url != null) {
            app.next_link = data.next_page_url;
            app.isLoading = true;
          } else {

            app.shouldLoad = false;
            
           // alert("Ok")
          }
        })
        .catch((error) => {
          console.log(error);
          //.showErrorMessage("Error Occured ");
        });
    },
    formatDate(date) {
      return moment(date).format("ddd[,] DD MMM YYYY");
    },
  },
};
</script>

<style scoped>
</style>
