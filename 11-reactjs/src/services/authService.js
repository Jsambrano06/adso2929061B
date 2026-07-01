import axiosClient from "../api/axiosClient";

export const authService = {
  async login(email, password) {
    const { data } = await axiosClient.post("/login", { email, password });
    if (data.token) {
      localStorage.setItem("token", data.token);
      localStorage.setItem("user", JSON.stringify(data.user));
    }
    return data;
  },

  async logout() {
    try {
      await axiosClient.post("/logout");
    } finally {
      localStorage.removeItem("token");
      localStorage.removeItem("user");
    }
  },

  getStoredUser() {
    const raw = localStorage.getItem("user");
    if (!raw) return null;
    try {
      return JSON.parse(raw);
    } catch {
      return null;
    }
  },

  getToken() {
    return localStorage.getItem("token");
  },

  isAuthenticated() {
    return !!localStorage.getItem("token");
  },
};
