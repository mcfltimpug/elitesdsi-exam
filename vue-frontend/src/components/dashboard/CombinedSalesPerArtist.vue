<template>
    <div class="row">
      <div class="d-flex justify-content-between flex-column flex-md-row align-items-center">
        <h4>Combined Albums Sales Per Artist</h4>
        <nav aria-label="Page navigation example">
          <ul class="pagination">
              <li class="page-item" :class="{ 'disabled': currentPage === 1 }">
                  <a class="page-link" href="#" @click.prevent="prevPage">Previous</a>
              </li>
              <!-- Display page numbers from 1 to 3 -->
              <li class="page-item" v-for="page in Math.min(5, Math.ceil(combinedSales.length / pageSize))" :key="page" :class="{ 'active': page === currentPage }">
                  <a class="page-link" href="#" @click.prevent="currentPage = page">{{ page }}</a>
              </li>
              <!-- Display 'Next' button for each remaining page -->
              <li class="page-item" v-if="currentPage < Math.ceil(combinedSales.length / pageSize)">
                  <a class="page-link" href="#" @click.prevent="nextPage">Next</a>
              </li>
          </ul>
      </nav>
      </div>
  
      <div class="col-12 col-md-4" v-for="(album, index) in paginatedSales" :key="index">
        <div class="card mb-3" style="max-width: 540px">
          <div class="row g-0 d-flex justify-content-center align-items-center">
            <div class="col-md-4 p-3 text-center">
              <img
                src="../../assets/album.png"
                class="img-fluid rounded-start"
                alt="..." width="100"
              />
            </div>
            <div class="col-md-8">
              <div class="card-body text-center">
                <p class="fw-bold">{{ album.artist }}</p>
                <p class="bg-warning rounded-pill">
                  Total Sales: {{ album.sales }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import axios from "axios";
  import { ref, onMounted, watch, computed } from "vue";
  
  const combinedSales = ref([
    {
      artist: "",
      sales: "",
    },
  ]);
  
  const currentPage = ref(1);
  const pageSize = 9;
  
  const nextPage = () => {
    currentPage.value++;
  };
  
  const prevPage = () => {
    currentPage.value--;
  };
  
  const paginatedSales = computed(() => {
    const startIndex = (currentPage.value - 1) * pageSize;
    const endIndex = startIndex + pageSize;
    return combinedSales.value.slice(startIndex, endIndex);
  });
  
  const loadArtistAlbums = async () => {
    try {
      const response = await axios.get(
        "http://127.0.0.1:8000/api/dashboard/combined-album-sales-per-artist"
      );
  
      //console.log(response.data[0].artist.name + response.data[0].combined_sales);
  
      combinedSales.value = response.data.map((item) => ({
        artist: item.artist.name,
        sales: item.combined_sales
      }));

    } catch (error) {
      console.error("Error loading albums:", error);
    }
  };
  
  onMounted(() => {
    loadArtistAlbums();
  });
  
  </script>