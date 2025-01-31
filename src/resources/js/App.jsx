const topCars = [
    [
        {
          "manufacturer_id": 9,
          "model": "C220",
          "type": "Sedan",
          "year": 2006,
          "image": "http://localhost/images/679bc4a700fd4.jpg"
        },
        {
          "manufacturer_id": 7,
          "model": "Impreza",
          "type": "Coupe",
          "year": 1998,
          "image": "http://localhost/images/679bc40445a61.jpg"
        },
        {
          "manufacturer_id": 11,
          "model": "Golf 4",
          "type": "Hatchback",
          "year": 2002,
          "image": "http://localhost/images/679bc56179262.jpg"
        }
      ]
    ];
    const selectedCar = {
        
            "manufacturer_id": 3,
            "model": "330i",
            "type": "Sedan",
            "year": 2004,
            "image": "http://localhost/images/679ba88e57ca2.jpg"
          
    };
    const relatedCars = [
        {
            "manufacturer_id": 7,
            "model": "Impreza",
            "type": "Coupe",
            "year": 1998,
            "image": "http://localhost/images/679bc40445a61.jpg"
          },
          {
            "manufacturer_id": 6,
            "model": "XC70 T6",
            "type": "Station Wagon",
            "year": 2010,
            "image": "http://localhost/images/679bc3aa95a49.jpg"
          },
          {
            "manufacturer_id": 9,
            "model": "C220",
            "type": "Sedan",
            "year": 2006,
            "image": "http://localhost/images/679bc4a700fd4.jpg"
          }
    ];
    

export default function App() {
// function to store Book ID in state
    function handleCarSelection(carID) {
        alert("Selected ID " + carID);
        }
        return (
        <>
        <Header />
        <main className="mb-8 px-2 md:container md:mx-auto">
        <Homepage handleCarSelection={handleCarSelection} />
        </main>
        <Footer />
        </>
        )
        
    }

    function Homepage({ handleCarSelection }) {
        return (
        <>
        {/* Remove one level of nesting by accessing first array element */}
        {topCars[0].map((car, index) => (
            <TopCarView
            car={car}
            key={`${car.manufacturer_id}-${car.model}`}
            index={index}
            handleCarSelection={handleCarSelection}
            />
        ))}
        </>
        )
    }
    
    function TopCarView({ car, index, handleCarSelection }) {
        return (
            <div className="bg-neutral-100 rounded-lg mb-8 py-8 flex flex-wrap md:flex-row">
                <div className={`order-2 px-12 md:basis-1/2 ${index % 2 === 1 ? "md:order-1 md:text-right" : ""}`}>
                    <p className="mb-4 text-3xl leading-8 font-light text-neutral-900">
                        {`${car.manufacturer_id} ${car.model}`}
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
                            alt={`${car.manufacturer_id} ${car.model}`}
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
        className="inline-block rounded-full py-2 px-4 bg-sky-500 hover:bgsky-400 text-sky-50 cursor-pointer"
        onClick={() => handleCarSelection(carID)}
        >See more</button>
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


    
    