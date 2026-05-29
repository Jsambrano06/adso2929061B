import { useEffect, useState } from "react";
import BtnBack from "../components/BtnBack";

function Example8DataFetching() {
    const [data, setData] = useState(null);

    useEffect(() => {
        setData({ message: "Example data loaded." });
    }, []);

    return (
        <div className="container">
            <BtnBack />
            <h1>Example8DataFetching</h1>
            <pre>{JSON.stringify(data, null, 2)}</pre>
        </div>
    );
}
export default Example8DataFetching;
