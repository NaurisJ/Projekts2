import { useEffect, useState } from "react";

import '../css/loader.css';


// Main application component
export default function App() {
    const [selectedCarID, setSelectedCarID] = useState(null);
    const [topCars, setTopCars] = useState([]);

    function handleCarSelection(carID) {
        setSelectedCarID(carID);
    }

    function handleGoingBack() {
        setSelectedCarID(null);
    }

    return (
        <>
            <Header />
            <main className="mb-8 px-2 md:container md:mx-auto">
                {selectedCarID ? (
                    <CarPage
                        selectedCarID={selectedCarID}
                        handleCarSelection={handleCarSelection}
                        handleGoingBack={handleGoingBack}
                        topCars={topCars}
                    />
                ) : (
                    <Homepage handleCarSelection={handleCarSelection} />
                )}
            </main>
            <Footer />
        </>
    );
}

    function Homepage({ handleCarSelection }) {
        const [topCars, setTopCars] = useState([]);
        const [isLoading, setIsLoading] = useState(false);
        const [error, setError] = useState(null);

        useEffect(function () {
            async function fetchTopCars() {
                try {
                    setIsLoading(true);
                    setError(null);
                    
                    
                    const response = await fetch('http://localhost/data/get-top-cars');
                    if (!response.ok) {
                        throw new Error("Error while loading data. Please reload page!");
                    }
                    const data = await response.json();
                    console.log('top cars fetched', data);
                    setTopCars(data);
                } catch (error) {
                    setError(error.message);
                } finally {
                    setIsLoading(false);
                }
            }
            fetchTopCars();
        }, []);
            
        useEffect(() => {
            console.log("topCars updated:", topCars);
        }, [topCars]); // Debug when topCars updates

            return (
                <>
                    {isLoading && <Loader />}
                    {error && <ErrorMessage msg={error} />}
                    {!isLoading && !error && (
                        topCars.map((car, index) => (
                            <TopCarView
                            car={car}
                            key={`${car.manufacturer_id}-${car.model}`}
                            index={index}
                            handleCarSelection={handleCarSelection}
                            />
                        ))
                    )}
                </>
                );
                
    }

    
    
    function TopCarView({ car, index, handleCarSelection }) {
        return (
            <div className="bg-neutral-100 rounded-lg mb-8 py-8 flex flex-wrap md:flex-row">
                <div className={`order-2 px-12 md:basis-1/2 ${index % 2 === 1 ? "md:order-1 md:text-right" : ""}`}>
                    <p className="mb-4 text-3xl leading-8 font-light text-neutral-900">
                        {car.model}
                    </p>
                    <p className="mb-4 text-xl leading-7 font-light text-neutral-900">
                        Year: {car.year}
                    </p>
                    <p className="mb-4 text-xl leading-7 font-light text-neutral-900">
                        Type: {car.type}
                    </p>
                    <SeeMoreBtn
                        carID={car.manufacturer_id}
                        handleCarSelection={handleCarSelection}
                    />
                </div>
                <div className={`order-1 md:basis-1/2 ${index % 2 === 1 ? "md:order-2" : ""}`}>
                    {car.image ? (
                        <img
                            src={car.image}
                            alt={`${car.model}`}
                            className="p-1 rounded-md border border-neutral-200 w-2/4 aspect-auto mx-auto"
                        />
                    ) : (
                        <p className="text-center">No Image</p>
                    )}
                </div>
            </div>
        );
    }

    function SeeMoreBtn({ carID, handleCarSelection }) {
        return (
            <button
                className="inline-block rounded-full py-2 px-4 bg-sky-500 hover:bg-sky-400 text-white cursor-pointer"
                onClick={() => handleCarSelection(carID)}
            >
                See more
            </button>
        );
    }
    
    
    // Loader and Error Message components
function Loader() {
    console.log("Loader is rendering...");const [isLoading, setIsLoading] = useState(true);
    return (
    <div className="my-12 px-2 md:container md:mx-auto text-center clear-both">
    <div className="loader"></div>
    </div>
    )
    }
    function ErrorMessage({ msg }) {
    return (
    <div className="md:container md:mx-auto bg-red-300 my-8 p-2">
    <p className="text-black">{ msg }</p>
    </div>
    )
    }
    

// Header and Footer components - structural components without processing or data
function Header() {
    return (
    <header className="bg-green-500 mb-8 py-2 sticky top-0">
    <div className="px-2 py-2 font-serif text-green-50 text-xl leading-6
    md:container md:mx-auto">
    Car Tracking
    </div>
    </header>
    )
    }
    function Footer() {
    return (
    <footer className="bg-neutral-300 mt-8">
    <div className="py-8 md:container md:mx-auto px-2">
    N. Jāvalds, VeA, 2025
    </div>
    </footer>
    )
    }


    function CarPage({ selectedCarID, handleCarSelection, handleGoingBack, topCars }) {
        // const allCars = [...(topCars.length ? topCars[0] : []), selectedCar, ...relatedCars];
        // const currentCar = allCars.find(car => car.manufacturer_id === selectedCarID) || null;

        console.log("topCars in CarPage:", topCars);
        console.log("selectedCarID:", selectedCarID);
    
        return (
            <>
                <SelectedCarView
                    selectedCarID={selectedCarID}
                    handleGoingBack={handleGoingBack}
                />
                <RelatedCarSection
                    selectedCarID={selectedCarID}
                    handleCarSelection={handleCarSelection}
                />
            </>
        );
    }
        
    
        
    function SelectedCarView({ selectedCarID, handleGoingBack }) {
        const [selectedCar, setSelectedCar] = useState({});
        const [isLoading, setIsLoading] = useState(false);
        const [error, setError] = useState(null);
    
        useEffect(function () {
            async function fetchSelectedCar() {
                try {
                    setIsLoading(true);
                    setError(null);
                    const response = await fetch('http://localhost/data/get-car/' + selectedCarID);
                    if (!response.ok) {
                        throw new Error("Error while loading data. Please reload page!");
                    }
                    const data = await response.json();
                    console.log('car ' + selectedCarID + ' fetched', data);
                    setSelectedCar(data);
                } catch (error) {
                    setError(error.message);
                } finally {
                    setIsLoading(false);
                }
            }
            fetchSelectedCar();
        }, [selectedCarID]);
    
        return (
            <>
                {isLoading && <Loader />}
                {error && <ErrorMessage msg={error} />}
                {!isLoading && !error && (
                    <div className="rounded-lg flex flex-col md:flex-row md:space-x-12">
    <div className="md:basis-1/2 flex flex-col justify-between mb-4 md:mb-0">
        <h1 className="text-3xl font-semibold text-neutral-900 mb-2">
            {selectedCar.model}
        </h1>
        <p className="text-xl font-light text-neutral-900 mb-2">
            Manufacturer ID: {selectedCar.manufacturer_id}
        </p>
        <p className="text-xl font-light text-neutral-900 mb-4">
            Type: {selectedCar.type}
        </p>
        <dl className="mb-4 md:flex md:flex-wrap">
            <dt className="font-bold md:basis-1/4">Year</dt>
            <dd className="mb-2 md:basis-3/4">{selectedCar.year}</dd>
        </dl>
    </div>

    <div className="md:basis-1/2 flex justify-center items-center mb-4 md:mb-0">
        {selectedCar.image ? (
            <img
                src={selectedCar.image}
                alt={selectedCar.model}
                className="p-1 rounded-md border border-neutral-200 w-full md:w-3/4"
            />
        ) : (
            <p className="text-center">No Image Available</p>
        )}
    </div>

    <div className="flex justify-center w-full mt-4 md:mt-0">
    <button
        onClick={handleGoingBack}
        className="px-6 py-3 bg-blue-600 text-white font-semibold text-lg rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-200"
    >
        Go Back
    </button>
</div>
</div>

                )}
            </>
        );
    }
    


// Go Back Button
function GoBackBtn({ handleGoingBack }) {
    return (
    <button
    className="inline-block rounded-full py-2 px-4 bg-neutral-500
    hover:bg-neutral-400 text-neutral-50 cursor-pointer"
    onClick={handleGoingBack}
    >Back</button>
    )
    }
    function RelatedCarSection({ selectedCarID, handleCarSelection }) {
        const [relatedCars, setRelatedCars] = useState([]);
        const [selectedCarType, setSelectedCarType] = useState(null);
        const [isLoading, setIsLoading] = useState(false);
        const [error, setError] = useState(null);
    
        // First useEffect to fetch the selected car's type
        useEffect(() => {
            async function fetchSelectedCarType() {
                try {
                    const response = await fetch(`http://localhost/data/get-car/${selectedCarID}`);
                    if (!response.ok) {
                        throw new Error("Error while loading selected car data.");
                    }
                    const data = await response.json();
                    setSelectedCarType(data.type);
                } catch (error) {
                    console.error("Error fetching selected car:", error);
                }
            }
            fetchSelectedCarType();
        }, [selectedCarID]);
    
        // Second useEffect to fetch related cars
        useEffect(() => {
            async function fetchRelatedCars() {
                try {
                    setIsLoading(true);
                    setError(null);
                    const response = await fetch(`http://localhost/data/get-related-cars/${selectedCarID}`);
                    if (!response.ok) {
                        throw new Error("Error while loading related cars.");
                    }
                    const data = await response.json();
                    setRelatedCars(data);
                } catch (error) {
                    setError(error.message);
                } finally {
                    setIsLoading(false);
                }
            }
            fetchRelatedCars();
        }, [selectedCarID]);
    
        // Filter cars by type and exclude the selected car, limit to 3
        const filteredRelatedCars = relatedCars
            .filter(car => 
                car.manufacturer_id !== selectedCarID && 
                car.type === selectedCarType
            )
            .slice(0, 3); // Limit to 3 cars
    
        if (isLoading) {
            return <Loader />;
        }
    
        if (error) {
            return <ErrorMessage msg={error} />;
        }
    
        if (filteredRelatedCars.length === 0) {
            return (
                <div className="text-center py-4">
                    <h2 className="text-3xl font-light text-neutral-900 mb-4">
                        Related Cars
                    </h2>
                    <p>No related cars of the same type found.</p>
                </div>
            );
        }
    
        return (
            <>
                <div className="flex flex-wrap">
                    <h2 className="text-3xl font-light text-neutral-900 mb-4">
                        Related {selectedCarType} Cars
                    </h2>
                </div>
                {/* Updated grid layout for 3 cards */}
                <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                    {filteredRelatedCars.map(car => (
                        <RelatedCarView
                            car={car}
                            key={car.manufacturer_id}
                            handleCarSelection={handleCarSelection}
                        />
                    ))}
                </div>
            </>
        );
    }
    function RelatedCarView({ car, handleCarSelection }) {
        if (!car) return null;
    
        return (
            <div className="rounded-lg bg-white shadow-md p-4">
                {car.image ? (
                    <img
                        src={car.image}
                        alt={car.model}
                        className="rounded-md w-full h-48 object-cover mb-4"
                    />
                ) : (
                    <p className="text-center">No Image Available</p>
                )}
                <div className="p-4">
                    <h3 className="text-xl font-semibold text-neutral-900 mb-2">
                        {car.model}
                    </h3>
                    <SeeMoreBtn
                        carID={car.manufacturer_id}
                        handleCarSelection={handleCarSelection}
                    />
                </div>
            </div>
        );
    }