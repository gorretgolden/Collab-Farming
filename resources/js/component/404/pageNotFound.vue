<template>
  <div>
    <NotFoundHeader />

    <div
      class="notfound"
    >
      <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
        <div style="display:flex">
         

          <div class="ml-1" style="font-weight:bold; font-size:30">
            PAGE NOT FOUND <router-link to="/">Go Back</router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import NotFoundHeader from "./notFoundHeader.vue";

export default {
  name: "page-not-found",
  components: { NotFoundHeader },
};
</script>
<style lang="scss" scoped>
.notfound{

    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 20rem;
}
</style>

