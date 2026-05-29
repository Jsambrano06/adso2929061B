import { BrowserRouter, Routes, Route } from "react-router-dom";
import "./App.css";
import Menu from "./components/Menu";
import Example1Componets from "./pages/Example1Componets";
import Example2JSX from "./pages/Example2JSX";
import Example3Props from "./pages/Example3Props";
import Example4StateHooks from "./pages/Example4StateHooks";
import Example5Events from "./pages/Example5Events";
import Example6ConditionalLists from "./pages/Example6ConditionalLists";
import Example7Routing from "./pages/Example7Routing";
import Example8DataFetching from "./pages/Example8DataFetching";

function App() {
  return (
    <BrowserRouter>
      <div className="App">
        <Routes>
          <Route path="/" element={<Menu />} />
          <Route path="/example1" element={<Example1Componets />} />
          <Route path="/example2" element={<Example2JSX />} />
          <Route path="/example3" element={<Example3Props />} />
          <Route path="/example4" element={<Example4StateHooks />} />
          <Route path="/example5" element={<Example5Events />} />
          <Route path="/example6" element={<Example6ConditionalLists />} />
          <Route path="/example7/*" element={<Example7Routing />} />
          <Route path="/example8" element={<Example8DataFetching />} />
        </Routes>
      </div>
    </BrowserRouter>
  );
}

export default App;
