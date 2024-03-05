<template>
  <section class="container dashboard mt-5">
    <div class="d-flex my-3 flex-column flex-md-row justify-content-between align-items-center">
      <h4 class="fw-bold text-primary">Dashboard</h4>
       <SearchedArtist />
    </div>
   
    <TopSellingArtist />
    <TotalSoldAlbumsPerArtist/>
    <CombinedSalesPerArtist/>
  </section>
</template>

<script setup>
import TopSellingArtist from "@/components/dashboard/TopSellingArtist.vue";
import TotalSoldAlbumsPerArtist from "@/components/dashboard/TotalSoldAlbumsPerArtist.vue";
import CombinedSalesPerArtist from "@/components/dashboard/CombinedSalesPerArtist.vue";
import SearchedArtist from "@/components/dashboard/SearchedArtist.vue";

</script>

<style scoped>

</style>