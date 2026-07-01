import { Routes, Route, Navigate } from "react-router-dom";
import ProtectedRoute from "../components/ProtectedRoute";
import Login from "../pages/Login";
import Dashboard from "../pages/Dashboard";
import AddPet from "../pages/AddPet";
import PetDetail from "../pages/PetDetail";
import EditPet from "../pages/EditPet";
import Settings from "../pages/Settings";

function AppRoutes() {
  return (
    <Routes>
      <Route path="/login" element={<Login />} />
      <Route
        path="/dashboard"
        element={
          <ProtectedRoute>
            <Dashboard />
          </ProtectedRoute>
        }
      />
      <Route
        path="/pets/add"
        element={
          <ProtectedRoute>
            <AddPet />
          </ProtectedRoute>
        }
      />
      <Route
        path="/pets/:id/edit"
        element={
          <ProtectedRoute>
            <EditPet />
          </ProtectedRoute>
        }
      />
      <Route
        path="/pets/:id"
        element={
          <ProtectedRoute>
            <PetDetail />
          </ProtectedRoute>
        }
      />
      <Route
        path="/settings"
        element={
          <ProtectedRoute>
            <Settings />
          </ProtectedRoute>
        }
      />
      <Route path="/" element={<Navigate to="/dashboard" replace />} />
      <Route path="*" element={<Navigate to="/dashboard" replace />} />
    </Routes>
  );
}

export default AppRoutes;
