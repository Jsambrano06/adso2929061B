import axiosClient from "../api/axiosClient";

const isFormData = (value) =>
  typeof FormData !== "undefined" && value instanceof FormData;

export const petService = {
  async list() {
    const { data } = await axiosClient.get("/pets/list");
    return data.pets || [];
  },

  async getById(id) {
    const { data } = await axiosClient.get(`/pets/show/${id}`);
    return data.pet;
  },

  async create(petData) {
    const { data } = await axiosClient.post("/pets/store", petData, {
      headers: isFormData(petData)
        ? { "Content-Type": "multipart/form-data" }
        : {},
    });
    return data.pet;
  },

  async update(id, petData) {
    const { data } = await axiosClient.put(`/pets/edit/${id}`, petData, {
      headers: isFormData(petData)
        ? { "Content-Type": "multipart/form-data" }
        : {},
    });
    return data.pet;
  },

  async remove(id) {
    await axiosClient.delete(`/pets/delete/${id}`);
  },
};
