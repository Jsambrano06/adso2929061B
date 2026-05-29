import { useState } from "react";
import BtnBack from "../components/BtnBack";

function Example4StateHooks() {
    const [count, setCount] = useState(0);

    return (
        <div className="container">
            <BtnBack />
            <h1>Example4StateHooks</h1>
            <p>Count: {count}</p>
            <button onClick={() => setCount(count + 1)}>Increment</button>
        </div>
    );
}
export default Example4StateHooks;
