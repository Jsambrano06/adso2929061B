import { Link } from "react-router-dom";
import BtnBack from "../components/BtnBack";

function Example7Routing() {
    return (
        <div className="container">
            <BtnBack />
            <h1>Example7Routing</h1>
            <p>Use the browser navigation or menu to switch routes.</p>
            <div>
                <Link to="/example1">Example 1</Link>
            </div>
        </div>
    );
}
export default Example7Routing;
