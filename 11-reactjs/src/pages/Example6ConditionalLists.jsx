import BtnBack from "../components/BtnBack";

function Example6ConditionalLists() {
    const items = ["React", "JSX", "Props", "Hooks"];

    return (
        <div className="container">
            <BtnBack />
            <h1>Example6ConditionalLists</h1>
            <ul>
                {items.map((item) => (
                    <li key={item}>{item}</li>
                ))}
            </ul>
        </div>
    );
}
export default Example6ConditionalLists;
