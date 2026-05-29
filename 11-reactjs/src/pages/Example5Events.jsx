import BtnBack from "../components/BtnBack";

function Example5Events() {
    const handleClick = () => alert("Button clicked!");

    return (
        <div className="container">
            <BtnBack />
            <h1>Example5Events</h1>
            <button onClick={handleClick}>Click me</button>
        </div>
    );
}
export default Example5Events;
